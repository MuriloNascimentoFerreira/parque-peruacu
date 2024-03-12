import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        {
            name: 'jquery',
            resolveId: (id) => {
                if (id === 'jquery') {
                    return path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js');
                }
            },
            load: (id) => {
                if (id === path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js')) {
                    return 'export default window.jQuery;';
                }
            },
        },
        {
            name: 'magnific-popup',
            resolveId: (id) => {
                if (id === 'magnific-popup') {
                    return path.resolve(__dirname, 'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js');
                }
            },
            load: (id) => {
                if (id === path.resolve(__dirname, 'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js')) {
                    return 'import "../node_modules/magnific-popup/dist/magnific-popup.css";\nexport default window.jQuery.magnificPopup;';
                }
            },
        },
        {
            name: 'owl.carousel',
            resolveId: (id) => {
                if (id === 'owl.carousel') {
                    return path.resolve(__dirname, 'node_modules/owl.carousel/dist/owl.carousel.min.js');
                }
            },
            load: (id) => {
                if (id === path.resolve(__dirname, 'node_modules/owl.carousel/dist/owl.carousel.min.js')) {
                    return 'import "../node_modules/owl.carousel/dist/owl.carousel.min.css";\nexport default window.OwlCarousel;';
                }
            },
        },
    ],
});
