import { createRouter,createWebHistory } from "vue-router";

import Invoice from '../components/Invoice/index.vue';
import NotFound from '../components/NotFound.vue';
import NewInvoice from '../components/Invoice/new.vue';
import show from '../components/Invoice/show.vue';

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
    },
    {
        path:'/invoice/showInvoice/:id',
        component:show
    }
];
const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;