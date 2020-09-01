<template>
  <div class="col-12">
    <div class="card border-0">
      <div class="card-header">Tabla</div>
      <div class="card-body alerta">
        <div class="form-group">
          <input
            class="form-control col-8 d-inline-block"
            type="text"
            v-model="tablesData.search"
            placeholder="Buscar"
            @input="getCategorias()"
          />
          <!-- 
        </div>
          <div class="form-group">-->
          <select
            class="form-control col-3 d-inline-block"
            v-model="tablesData.length"
            @change="getCategorias()"
          >
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="60">60</option>
            <option value="70">70</option>
            <option value="80">80</option>
            <option value="90">90</option>
            <option value="100">100</option>
          </select>
        </div>
        <data-table :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody v-if="categorias">
            <table-row v-for="categoria in categorias" :key="categoria.id" :categoria="categoria"></table-row>
          </tbody>
          <tbody v-else>
            <tr>
              <td :colspan="columns.length" class="text-center">---- No existen elementos. ----</td>
            </tr>
            <!-- <tr class="text-center">No existen elementos.</tr> -->
          </tbody>
        </data-table>
        <pagination-table :pagination="pagination" @prev="lessOne" @next="plusOne"></pagination-table>

        <modal-form :categorias="categorias"></modal-form>
      </div>
    </div>
  </div>
</template>

<script>
import Datatable from "../dataTables/Datatable.vue";
import PaginationTable from "../dataTables/PaginationTable.vue";
import TableRow from "../dataTables/TableRow.vue";

export default {
  components: { datatable: Datatable, paginationTable: PaginationTable },
  data() {
    let sortOrders = {};
    let columns = [
      { width: "15%", label: "#", name: "id" },
      { width: "35%", label: "Nombre", name: "nombre" },
      { width: "25%", label: "#Usuario", name: "autor" },
      { width: "25%", label: "Aciones", name: "accion" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      //eliminando: false,
      categorias: [],
      columns: columns,
      sortKey: "id",
      sortOrders: sortOrders,
      tablesData: {
        page: 1,
        draw: 0,
        length: 10,
        column: "id",
        search: "",
        dir: "desc",
      },
      pagination: {
        lastPage: "",
        currentPage: "",
        total: "",
        lastPageUrl: "",
        nextPageUrl: "",
        prevPageUrl: "",
        from: "",
        to: "",
      },
      categoriaEdit: null,
    };
  },
  mounted() {
    this.getCategorias();
    EventBus.$on("categoria-creada", (categoria) => {
      this.categorias.unshift(categoria);
    });
    EventBus.$on("categoria-deleted", (id) => {
      this.eliminarCategoria(id);
    });
    $("#exampleModal").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data("id"); // Extract info from data-* attributes

      EventBus.$emit("categoria-para-editar", recipient);
    });
  },
  methods: {
    eliminarCategoria(id) {
      var flag = false;
      var i = 0;
      while (this.categorias.length > i && !flag) {
        if (this.categorias[i].id == id) {
          flag = true;
          this.categorias.splice(i, 1);
          return;
        }
        i++;
      }
    },
    getCategorias(url = "/categorias") {
      this.tablesData.draw++;
      axios
        .get(url, { params: this.tablesData })
        .then((res) => {
          /* let data = res.data;
          console.log(res);
          if (this.tablesData.draw == data.draw) {
            console.log('sss');
            this.categorias = res.data.data;
            this.configPagination(res.data);
          } */
          this.categorias = res.data.data;
          this.configPagination(res.data);
          for(var i=0; i<this.categorias.length; i++){
            this.categorias[i].updated = true;
          }
          /* if(this.eliminando){
            this.eliminando = false;
            $('.alerta').append('Categoría Eliminada');
          } */
          /* console.log(res.data); */
        })
        .catch((err) => {
          console.log(err);
        });
      /* EventBus.$on("categoria-creada", (categoria) => {
        this.getCategorias();
      }); */
    },
    configPagination(data) {
      this.pagination.lastPage = data.last_page;
      this.pagination.currentPage = data.path;
      this.pagination.total = data.total;
      this.pagination.lastPageUrl = data.last_page_url;
      this.pagination.nextPageUrl = data.next_page_url;
      this.pagination.prevPageUrl = data.prev_page_url;
      this.pagination.from = data.from;
      this.pagination.to = data.to;
    },
    sortBy(key) {
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
      this.tablesData.column = key;
      this.tablesData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
      this.getCategorias();
    },
    plusOne() {
      this.tablesData.page++;
      this.getCategorias();
    },
    lessOne() {
      this.tablesData.page--;
      this.getCategorias();
    },
  },
};
</script>

<style scoped>
</style>