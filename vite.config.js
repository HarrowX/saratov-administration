import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    build: {
        minify: false,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin/cropper.min.css',
                'resources/css/admin/moonshine-cropper.css',
                'resources/js/admin/cropper.min.js',
                'resources/js/admin/cropper-init.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
