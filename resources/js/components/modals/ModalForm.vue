<style>
button {
  width: auto;
}
</style>
<template>
  <!-- Vertically centered scrollable modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    data-backdrop="static"
    data-keyboard="false"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="submit">
          <div class="modal-body">
            <div class="form-group">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input
                type="text"
                class="form-control"
                id="nombre"
                name="nombre"
                v-model="categoria.nombre"
                @change="cambiarColorRojo()"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="guardar"><span><i class="fa fa-save mr-1"></i></span>Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["categorias"],
  data() {
    return {
      id: 0,
      categoria: {
        nombre: "",
        updated: false,
      },
    };
  },
  mounted() {
    EventBus.$on("categoria-para-editar", (id) => {
      if (id != this.id) {
        this.id = id;
        this.buscarCategoria();
      }
    });
  },
  methods: {
    submit() {
      $("#guardar").prop("disabled", true);
        $("#guardar").html(`
          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Guardando...
        `);
      axios
        .put("/categorias/update/" + this.categoria.id, this.categoria)
        .then((res) => {
          this.categoria.nombre = res.data.nombre;
        })
        .catch((err) => {
          console.log(err.response.data);
        })
        .finally( () => {
          $("#guardar").prop("disabled", false);
          $("#guardar").html(`
            <span><i class="fa fa-save mr-1"></i></span>
              Guardar
          `);
          this.cambiarColorNegro();
        });
    },
    buscarCategoria() {
      var encontrado = false;
      var i = 0;

      while (i < this.$props.categorias.length && !encontrado) {
        if (this.$props.categorias[i].id == this.id) {
          encontrado = true;
          this.categoria = this.$props.categorias[i];
        }
        i++;
      }
    },
    cambiarColorRojo(){
      this.categoria.updated = true;
      EventBus.$emit("categoria-updating", this.categoria);
    },
    cambiarColorNegro(){
      this.categoria.updated = false;
      EventBus.$emit("categoria-updating", this.categoria);
    }
  },
};
</script>