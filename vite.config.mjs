import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/js/mains/blog/admin/index.js',
                'resources/js/mains/contact/admin/index.js'
            ],
            refresh: true,
        }),
    ],
});