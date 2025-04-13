import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import dotenv from 'dotenv';
dotenv.config();

let PORT = 5173
export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: process.env.VITE_DEV_HOST,
            port: PORT,
        },
        cors: true,
        origin: 'http://'+ process.env.VITE_DEV_HOST+':'+ PORT
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
