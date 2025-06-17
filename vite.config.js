import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import dotenv from 'dotenv';
dotenv.config();

let confignya;
if (process.env.APP_ENV !== 'local') {
    console.warn('Vite is running in non-local environment. Ensure that your configuration is correct.');
    confignya = {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
    };

} else {
    console.log('Vite is running in local environment.');
    let PORT = 5173
    confignya = {
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
    };
}

export default defineConfig(confignya);