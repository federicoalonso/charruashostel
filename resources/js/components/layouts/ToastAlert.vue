<style>
.toastAlert {
  position: fixed;
  width: 33vw;
  right: 20px;
  top: 20px;
}

.toastAlert .alert {
  border-radius: 8px;
  padding: 10px;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2), 15px 15px 15px rgba(0, 0, 0, 0.2);
  transform: translateY(-20px);
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s;
}

.toastAlert .alert span {
  margin-right: 5px;
  float: right;
  opacity: 0.6;
}

.toastAlert .alert span:hover {
  cursor: pointer;
  transform: scale(1.02);
  opacity: 1;
}

.toastAlert .alert.visible {
  transform: translateY(0px);
  opacity: 1;
  visibility: visible;
}

.toastAlert .alert.success {
  border: 1px solid green;
  background: rgba(1, 189, 1, 0.452);
}

.toastAlert .alert.danger {
  border: 1px solid orange;
  background: rgba(255, 166, 0, 0.445);
}

.toastAlert .alert.error {
  border: 1px solid red;
  background: rgba(255, 0, 0, 0.459);
}

.toastAlert .alert.success:hover {
  background: rgba(1, 189, 1, 0.774);
  cursor: pointer;
}

.toastAlert .alert.danger:hover {
  background: rgba(255, 166, 0, 0.774);
  cursor: pointer;
}

.toastAlert .alert.error:hover {
  background: rgba(255, 0, 0, 0.774);
  cursor: pointer;
}
</style>
<template>
  <div class="toastAlert">
    <div
      v-for="alert in alerts"
      :key="alert.ide"
      :id="alert.ide"
      class="alert"
      :class="alert.type "
    >
      {{ alert.body }}
      <span :id="'span' + alert.ide">
        <i class="fa fa-times ml-auto"></i>
      </span>
    </div>
  </div>
</template>
<script>
export default {
  props: [],
  data() {
    return {
      alerts: [],
    };
  },
  methods: {
    volverVisible(ide) {
      setTimeout(function () {
        document.getElementById(`${ide}`).classList.add("visible");
      }, 200);
    },
    eliminarAlerta(ide) {
      var flag = false;
      var i = 0;
      while (this.alerts.length > i && !flag) {
        if (this.alerts[i].ide == ide) {
          flag = true;
          this.alerts.splice(i, 1);
          return;
        }
        i++;
      }
    },
  },
  mounted() {
    EventBus.$on("alert-display", (alerta) => {
      this.alerts.push(alerta);
      this.volverVisible(alerta.ide);
      if (alerta.autoRemove) {
        var timerOut = setTimeout(function () {
          document.getElementById(`${alerta.ide}`).classList.remove("visible");
          setTimeout(function () {
            EventBus.$emit("alert-dismiss", alerta.ide);
          }, 500);
        }, alerta.timeOut * 1000);
        setTimeout(function () {
          document
            .getElementById(`span${alerta.ide}`)
            .addEventListener("click", function () {
              document
                .getElementById(`${alerta.ide}`)
                .classList.remove("visible");
              setTimeout(function () {
                EventBus.$emit("alert-dismiss", alerta.ide);
              }, 500);
              clearTimeout(timerOut);
            });
        }, 200);
      }
    });
    EventBus.$on("alert-dismiss", (ide) => {
      this.eliminarAlerta(ide);
    });
  },
};
</script>