import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Home';
import List from './views/List';

Vue.use(VueRouter)

const routes = [{
        path: '/home',
        name: 'Home',
        component: Home
    },
    {
        path: '/list/:id',
        name: 'List',
        component: List,
        props: true
    }

]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;
