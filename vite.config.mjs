import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/js/mains/admin/blog/index.js',
                'resources/js/mains/admin/contact/index.js'
            ],
            refresh: true,
        }),
    ],
});