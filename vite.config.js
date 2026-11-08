import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/js/app.js',
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'resources/js/admin-confirm.js',
                    'resources/js/admin-dashboard-charts.js',
                    'resources/css/electrohub-auth.css',

                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
