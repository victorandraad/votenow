import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            // Adicionando a configuração do manifest
            manifest: {
                "resources/css/app.css": {
                    "file": "assets/app-CYfl3af-.css",
                    "src": "resources/css/app.css",
                    "isEntry": true
                },
                "resources/js/app.js": {
                    "file": "assets/app-DLXkxiZ3.js",
                    "name": "app",
                    "src": "resources/js/app.js",
                    "isEntry": true
                }
            }
        }),
    ],
});
