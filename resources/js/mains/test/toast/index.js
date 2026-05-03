import { createApp } from 'vue'
import ToastButton from '../../../components/test/ToastButton.vue';
import Vue3Toastify from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const app = createApp(ToastButton)

app.use(Vue3Toastify, {
  autoClose: 6000,
  position: 'top-right',
  theme: 'light'
})

app.mount('#app');
