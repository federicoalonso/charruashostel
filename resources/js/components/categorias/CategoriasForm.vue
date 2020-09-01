<template>
  <div>
    <form @submit.prevent="submit">
      <div class="card-header">Categorías</div>
      <div class="card-body">
        <input
          v-model="nombre"
          name="nombre"
          :class="['form-control',  'border-0', (nombreFeedback) ? 'is-invalid' : '']"
          type="text"
          placeholder="Ingrese la Categoría"
        />
        <div v-text="nombreFeedback" class="invalid-feedback">Please provide a valid city.</div>
      </div>
      <div class="card-footer">
        <input type="submit" id="btn-guardar" value="Publicar" class="btn btn-success" />
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nombre: "",
      nombreFeedback: '',
    };
  },
  methods: {
    submit() {
      axios
        .post("/categorias", { nombre: this.nombre })
        .then((res) => {
          this.nombre = "";
          this.nombreFeedback = "";
          EventBus.$emit("categoria-creada", res.data);
          EventBus.$emit("alert-display", {
            body: "Categoría creada con éxito!!",
            type: "success",
            ide: parseInt(Math.random() * 10000),
            autoRemove: true,
            timeOut: 5,
          });
        })
        .catch((err) => {
          if (err.response.data.errors) {
            EventBus.$emit("alert-display", {
              body: "Ha ocurrido un error",
              type: "error",
              ide: parseInt(Math.random() * 10000),
              autoRemove: true,
              timeOut: 8,
            });
          }
          if (err.response.data.errors.nombre) {
            this.nombreFeedback = err.response.data.errors.nombre.toString();
          }/* 
          console.log(err.response.data); */
        });
    },
  },
};
</script>

<style scoped>
</style>