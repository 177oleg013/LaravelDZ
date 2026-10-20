import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: ['resources/scss/reset.scss', 'resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        ...(mode === 'sass' ? [] : [tailwindcss()]),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
}));
