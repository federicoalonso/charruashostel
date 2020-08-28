<template>
  <div class="col-12">
    <div class="card border-0">
      <div class="card-header">Tabla</div>
      <div class="card-body">
        <div class="form-group">
          <input
            class="form-control col-8 d-inline-block"
            type="text"
            v-model="tablesData.search"
            placeholder="Buscar"
            @input="getCategorias()"
          /><!-- 
        </div>
        <div class="form-group"> -->
          <select class="form-control col-3 d-inline-block" v-model="tablesData.length" @change="getCategorias()">
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="60">60</option>
            <option value="70">70</option>
          </select>
        </div>
        <data-table :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody>
            <tr v-for="categoria in categorias" :key="categoria.id">
              <td>{{ categoria.id }}</td>
              <td>{{ categoria.nombre }}</td>
              <td>{{ categoria.user_id }}</td>
            </tr>
          </tbody>
        </data-table>
        <pagination-table :pagination="pagination" @prev="lessOne" @next="plusOne"></pagination-table>
      </div>
    </div>
  </div>
</template>

<script>
import Datatable from "./Datatable.vue";
import PaginationTable from "./PaginationTable.vue";

export default {
  components: { datatable: Datatable, paginationTable: PaginationTable },
  data() {
    let sortOrders = {};
    let columns = [
      { width: "33%", label: "#", name: "id" },
      { width: "33%", label: "Nombre", name: "nombre" },
      { width: "33%", label: "#Usuario", name: "user_id" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
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
    };
  },
  mounted() {
    this.getCategorias();
    EventBus.$on("categoria-creada", (categoria) => {
      this.categorias.unshift(categoria);
    });
  },
  methods: {
    getCategorias(url = "/categorias") {
      this.tablesData.draw++;
      axios
        .get(url, { params: this.tablesData })
        .then((res) => {
          let data = res.data;
          if (this.tablesData.draw == data.draw) {
            this.categorias = data.data.data;
            this.configPagination(data.data);
          }
          this.categorias = res.data.data;
          this.configPagination(res.data);
          /* console.log(res.data); */
        })
        .catch((err) => {
          console.log(err);
        });
      EventBus.$on("categoria-creada", (categoria) => {
        this.getCategorias();
      });
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