import { createRouter,createWebHistory } from "vue-router";

import Invoice from '../components/Invoice/index.vue';
import NotFound from '../components/NotFound.vue';
import NewInvoice from '../components/Invoice/new.vue';

const routes = [
    {
        path:'/',
        component:Invoice
    },
    {
        path:'/:pathMatch(.*)*',
        component:NotFound
    },
    {
        path:'/invoice/new',
        component:NewInvoice
    }
];
const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;