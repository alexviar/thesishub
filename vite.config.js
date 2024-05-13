import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/trabajos_grado/EstudianteItem.js',

                'resources/sass/components/searchable_select.scss',
                'resources/js/components/SearchableSelect.js'
            ],
            refresh: true,
        }),
    ],
});
