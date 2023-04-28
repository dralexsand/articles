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