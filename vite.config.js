import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import dotenv from 'dotenv';
dotenv.config();

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: process.env.VITE_DEV_HOST,
            port: 5173,
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
