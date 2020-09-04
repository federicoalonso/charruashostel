<style>
.confirmationAlertBG {
  position: relative;
  position: fixed;
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s;
  transform: translateY(-20px);
}
.confirmationAlertBG.confActivo {
  background: rgba(0, 0, 0, 0.7);
  width: 100vw;
  height: 100vh;
  top: 0;
  right: 0;
  z-index: 1001;
  opacity: 1;
  visibility: visible;
  transform: translateY(0px);
}
.confirmationAlertBG.confActivo .confirmationCard {
  position: relative;
  position: absolute;
  width: 50%;
  height: 70%;
  background: floralwhite;
  left: 25%;
  top: 15%;
  border-radius: 5px;
  border: 1px solid black;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2), 15px 15px 15px rgba(0, 0, 0, 0.2);
}
.confirmationAlertBG.confActivo .confirmationCard .confirmationHead {
  background: cadetblue;
  padding: 15px;
  text-align: center;
  border-radius: 5px 5px 0 0;
  text-align: center;
}
.confirmationAlertBG.confActivo .confirmationCard .confirmationFooter {
  background: rgb(230, 230, 230);
  padding: 15px;
  position: absolute;
  bottom: 0;
  width: 100%;
  border-radius: 0 0 5px 5px;
}
</style>
<template>
  <div class="confirmationAlertBG" @click="volverInVisible" id="confirmationAlertBG">
    <div class="confirmationCard">
      <div class="confirmationHead">
        <h1 v-text="mensaje.titulo">Eliminar elemento</h1>
      </div>
      <div class="confirmationBody">
        <h2 v-text="mensaje.texto">Está seguro que desea eliminar el elemento?????</h2>
      </div>
      <div class="confirmationFooter">
        <input type="button" value="Eliminar" @click="delMethod" class="btn btn-danger" />
        <input type="button" @click="volverInVisible" value="Cancelar" class="btn btn-secondary" />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      mensaje: {
        titulo: "",
        texto: "",
        ruta: "",
        metodo: "",
        objeto: "",
        id: "",
      },
    };
  },
  methods: {
    volverVisible() {
      setTimeout(function () {
        document
          .getElementById("confirmationAlertBG")
          .classList.add("confActivo");
      }, 200);
    },
    delMethod() {
      axios
        .delete(this.mensaje.ruta)
        .then((res) => {
          this.volverInVisible();
          EventBus.$emit("categoria-deleted", this.mensaje.id);
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    },
    volverInVisible() {
      setTimeout(function () {
        document
          .getElementById("confirmationAlertBG")
          .classList.remove("confActivo");
      }, 200);
    },
  },
  mounted() {
    EventBus.$on("confirm-alert-display", (msj) => {
      this.volverVisible();
      this.mensaje.titulo = msj.titulo;
      this.mensaje.texto = msj.texto;
      this.mensaje.ruta = msj.ruta;
      this.mensaje.metodo = msj.metodo;
      this.mensaje.objeto = msj.objeto;
      this.mensaje.id = msj.id;
    });
  },
};
</script>