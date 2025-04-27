import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                // Define o padrão para os nomes dos arquivos
                entryFileNames: 'assets/app.js',
                chunkFileNames: 'assets/[name].js',
                assetFileNames: 'assets/[name].[ext]',
                manualChunks: () => {
                    return 'app'; // Força todos os chunks a serem agrupados em um único arquivo app.js
                },
            },
        },
    },
    server: {
        https: true,
    },
});
