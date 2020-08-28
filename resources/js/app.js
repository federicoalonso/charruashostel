require('./bootstrap');

import Vue from 'vue';


/* ************************************************************
                            RUTAS
************************************************************ */

import router from './routes.js';

/* ************************************************************
                            EVENTOS
************************************************************ */

window.EventBus = new Vue();

/* ************************************************************
                            COMPONENTS
************************************************************ */

/* Vue.component('categorias-page', require('./components/categorias/CategoriasPage.vue').default); */
Vue.component('categorias-form', require('./components/categorias/CategoriasForm.vue').default);
Vue.component('categorias-list', require('./components/categorias/CategoriasList.vue').default);
Vue.component('data-table', require('./components/dataTables/Datatable.vue').default);
Vue.component('pagination-table', require('./components/dataTables/PaginationTable.vue').default);
Vue.component('table-row', require('./components/dataTables/TableRow.vue').default);
Vue.component('menu-superior', require('./components/layouts/MenuSuperior.vue').default);
Vue.component('sidebar-menu', require('./components/layouts/SidebarMenu.vue').default);

const app = new Vue({
    el: '#app',
    router
});
