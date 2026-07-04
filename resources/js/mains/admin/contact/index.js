import { createApp } from 'vue';
import { createPinia } from 'pinia';

import ContactHub from '../../../components/admin/contact/ContactHub.vue';

import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import axios from 'axios';

import router from '../../../router/admin/contact';

import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import 'dayjs/locale/fr';

dayjs.extend(relativeTime);
dayjs.locale('fr');

// ----------------------
// Axios CSRF
// ----------------------
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('❌ CSRF token introuvable');
}


// ----------------------
// Mount Vue
// ----------------------
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('contact_hub');

    if (!el) {
        console.warn('❌ #contact_hub introuvable dans le DOM');
        return;
    }

    const app = createApp(ContactHub);

    app.use(createPinia());
    app.use(router);

    app.use(Vue3Toastify, {
        autoClose: 4000,            // durée fixe fiable
        closeOnClick: true,
        pauseOnHover: false,
        pauseOnFocusLoss: false,
        hideProgressBar: true,
        newestOnTop: true,
        draggable: true,
        theme: 'light',
        limit: 3,                   // évite accumulation de toasts bloqués
    });

    app.config.globalProperties.$dayjs = dayjs;

    app.mount(el);
});