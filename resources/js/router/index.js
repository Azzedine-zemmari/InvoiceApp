import { createRouter,createWebHistory } from "vue-router";

import Invoice from '../components/Invoice/index.vue';
import NotFound from '../components/NotFound.vue';
import NewInvoice from '../components/Invoice/new.vue';
import show from '../components/Invoice/show.vue';
import edit from '../components/Invoice/edit.vue';

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
        component:show,
        props: true
    },
    {
        path:'/invoice/edit/:id',
        component:edit,
        props: true
    }
];
const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;