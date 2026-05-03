import { createApp } from 'vue';
import { createPinia } from 'pinia';

import ContactHub from '../../../components/contact/admin/ContactHub.vue'; 
import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';   // ✅ CORRECTION
window.bootstrap = bootstrap;             // ✅ CORRECTION

import Echo from 'laravel-echo';
import Pusher from "pusher-js";
import axios from "axios";

import router from '../../../router/contact/admin';

import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import 'dayjs/locale/fr'

dayjs.extend(relativeTime)
dayjs.locale('fr')

// const bootstrap = require('bootstrap');

// ✅ Configuration Axios pour le CSRF
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error("❌ CSRF token not found!");
}

// ✅ Config Echo
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    withCredentials: true
});

document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('contact_hub');

    if (el) {
        const app = createApp(ContactHub);

        app.use(createPinia());

        app.use(router);

        app.use(Vue3Toastify, {
            autoClose: 6000,
            position: 'top-right',
            theme: 'light'
        });

        app.config.globalProperties.$dayjs = dayjs

        app.mount(el);
    } else {
        console.warn('⚠️ Élément #comment_hub introuvable dans le DOM');
    }
});