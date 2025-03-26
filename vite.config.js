import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/css/app1.css','resources/css/app2.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
