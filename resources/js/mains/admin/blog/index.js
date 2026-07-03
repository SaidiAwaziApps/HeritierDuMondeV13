import { createApp } from 'vue';
import CommentHub from '../../../components/admin/blog/commentaire/CommentHub.vue';

import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';

import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import 'dayjs/locale/fr';

dayjs.extend(relativeTime);
dayjs.locale('fr');

/**
 * =========================
 * BOOTSTRAP (VITE SAFE)
 * =========================
 * ❌ IMPORTANT : PAS DE require()
 */
import * as bootstrap from 'bootstrap';

/**
 * =========================
 * AXIOS CONFIG
 * =========================
 */
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.warn("⚠️ CSRF token introuvable");
}

/**
 * =========================
 * ECHO SAFE INIT
 * =========================
 */
// try {
//     window.Pusher = Pusher;

//     window.Echo = new Echo({
//         broadcaster: 'pusher',
//         key: import.meta.env.VITE_PUSHER_APP_KEY,
//         cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//         forceTLS: true,
//         withCredentials: true,
//     });

//     console.log('[Echo] OK');

// } catch (error) {
//     console.error('[Echo ERROR]', error);
// }

/**
 * =========================
 * VUE MOUNT SAFE
 * =========================
 */
function mountVue() {
    const el = document.getElementById('comment_hub');

    console.log('[Vue] element:', el);

    if (!el) {
        console.warn('❌ #comment_hub introuvable');
        return;
    }

    const app = createApp(CommentHub, {
        article: window.article,
    });

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

    console.log('[Vue] mounted OK');
}

/**
 * =========================
 * SAFE EXECUTION (VITE)
 * =========================
 */
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mountVue);
} else {
    mountVue();
}