import { createRouter, createWebHistory } from "vue-router";
import AuthMessageGroupView from "../../../views/admin/contact/AuthMessageGroupView.vue";
import AuthMessageListView from "../../../views/admin/contact/AuthMessageListView.vue";

const routes = [
    {
        name: 'AuthMessageGroupView',
        path: '/admin/contact/index',
        component: AuthMessageGroupView,
    },
    {
        name: 'AuthMessageListView',
        path: '/admin/contact/list', // pas de :expediteur
        component: AuthMessageListView,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
