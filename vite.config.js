import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // build: {
    //     rollupOptions: {
    //         external: ['vue', 'pinia'],
    //         output: {
    //             globals: {
    //                 vue: 'Vue',
    //                 pinia: 'pinia'
    //             }
    //         }
    //     }
    // }
});
