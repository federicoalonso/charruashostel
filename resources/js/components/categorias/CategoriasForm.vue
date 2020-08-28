<template>
  <div>
    <form @submit.prevent="submit">
      <div class="card-header">Categorías</div>
      <div class="card-body">
        <input
          v-model="nombre"
          name="nombre"
          class="form-control border-0"
          type="text"
          placeholder="Ingrese la Categoría"
        />
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
    };
  },
  methods: {
    submit() {
      axios
        .post("/categorias", { nombre: this.nombre })
        .then((res) => {
          this.nombre = '';
          EventBus.$emit('categoria-creada', res.data);
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    },
  },
};
</script>

<style scoped>
</style>