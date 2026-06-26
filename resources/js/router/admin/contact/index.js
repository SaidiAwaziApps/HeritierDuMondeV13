import { createRouter, createWebHistory } from "vue-router";
import AuthMessageGroupView from "../../../views/contact/admin/AuthMessageGroupView.vue";
import AuthMessageListView from "../../../views/contact/admin/AuthMessageListView.vue";

const routes = [
    {
        name: 'AuthMessageGroupView',
        path: '/contact/index',
        component: AuthMessageGroupView,
    },
    {
        name: 'AuthMessageListView',
        path: '/contact/list', // pas de :expediteur
        component: AuthMessageListView,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
