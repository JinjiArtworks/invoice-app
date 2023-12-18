import { createRouter, createWebHistory } from "vue-router";

import invoiceIndex from '../components/invoices/Index.vue'
import createInvoice from '../components/invoices/Create.vue'
import notFound from '../components/NotFound.vue'
import invoiceShow from '../components/invoices/Show.vue'
import invoiceEdit from '../components/invoices/Edit.vue'
const routes = [
    {
        path: '/',
        component: invoiceIndex,
    },
    {
        path: '/invoice/new',
        component: createInvoice,
    },
    {
        path: '/invoice/show/:id',
        component: invoiceShow,
    },
    {
        path: '/invoice/edit/:id',
        component: invoiceEdit,
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound,
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router