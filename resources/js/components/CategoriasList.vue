<template>
  <div class="col-12">
    <div class="card border-0">
      <div class="card-header">
        Tabla
      </div>
      <div class="card-body"></div>
    </div>
    <div class="card border-0 mt-4">
      <div v-for="categoria in categorias" v-text="categoria.nombre"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categorias: [],
    };
  },
  mounted() {
    axios
      .get("/categorias")
      .then((res) => {
        this.categorias = res.data.data;
      })
      .catch((err) => {
        console.log(err);
      });
    EventBus.$on("categoria-creada", (categoria) => {
      this.categorias.unshift(categoria);
    });
  },
  methods: {
  }
};
</script>

<style scoped>
</style>