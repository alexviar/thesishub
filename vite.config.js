import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'app/Modules/Biblioteca/Resources/assets/js/trabajos_grado/publicar.js'
            ],
            refresh: true,
        }),
    ],
});
