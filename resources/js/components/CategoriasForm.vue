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
    <div v-for="categoria in categorias" v-text="categoria.nombre"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nombre: "",
      categorias: [],
    };
  },
  methods: {
    submit() {
      axios
        .post("/categorias", { nombre: this.nombre })
        .then((res) => {
          this.nombre = '';
          this.categorias.push(res.data);
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