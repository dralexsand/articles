import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/views/pages/Home.vue'),
        meta: {
            position: 'topnav',
            order: 1,
        },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/views/pages/Login.vue'),
        meta: {
            position: 'topnav',
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
        component: () => import('../components/views/pages/PageCreate.vue'),
        meta: {
            position: 'actions',
            order: 5,
        },
    },
    {
        path: '/demo',
        name: 'demo',
        component: () => import('../components/views/pages/DemoPage.vue'),
        meta: {
            position: 'topnav',
            order: 11,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router