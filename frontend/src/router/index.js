import {createRouter, createWebHistory} from "vue-router";
import guest from "./middleware/guest.js";

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/views/pages/Home.vue'),
        meta: {
            position: 'topnav',
            order: 1,
            middleware: [
                guest
            ]
        },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/views/pages/Login.vue'),
        meta: {
            position: 'auth',
            order: 5,
        },
    },
    {
        path: '/view/:id',
        name: 'view',
        component: () => import('../components/views/pages/Page.vue'),
        meta: {
            position: 'actions',
            order: 5,
        },
    },
    {
        path: '/edit/:id',
        name: 'edit',
        component: () => import('../components/views/pages/Page.vue'),
        meta: {
            position: 'actions',
            order: 5,
        },
    },
    {
        path: '/create',
        name: 'create',
        component: () => import('../components/views/pages/Page.vue'),
        meta: {
            position: 'actions',
            order: 5,
        },
    },
    {
        path: '/demo',
        name: 'demo',
        component: () => import('../components/views/pages/Demo.vue'),
        meta: {
            position: 'topnav',
            order: 119,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router