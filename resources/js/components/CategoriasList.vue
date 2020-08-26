<template>
  <div class="col-12">
    <div class="card border-0">
      <div v-for="categoria in categorias" v-text="categoria.nombre"></div>
      <table id="table_id" class="display data-table-js">
        <thead>
          <tr>
            <th>Column 1</th>
            <th>Column 2</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
          </tr>
          <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
          </tr>
        </tbody>
      </table>
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