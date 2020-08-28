import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

/* ************************************************************
                            RUTAS
************************************************************ */

export default new Router({
    routes: [
        {
            name: 'home',
            path: '/inicio',
            component: {
                template: '<div><br><br><br><br>Homeasd asdasd ad dda asd    asdadas dasd as dsadasdpspspspspsps</div>'
            },
        },
        {
            name: 'productos.configuracion',
            path: '/productos/configuracion',
            component: require('./components/categorias/CategoriasPage').default,
        },
        {
            path: '*',
            component: require('./components/404').default,
        },
    ],
});