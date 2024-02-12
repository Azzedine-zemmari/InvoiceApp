import { createRouter,createWebHistory } from "vue-router";

import Invoice from '../components/Invoice/index.vue';
import NotFound from '../components/NotFound.vue';

const routes = [
    {
        path:'/',
        component:Invoice
    },
    {
        path:'/:pathMatch(.*)*',
        component:NotFound
    }
];
const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;