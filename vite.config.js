import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/global.scss'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "/resources/css/theme.scss";`,
            },
        },
    },
    server: {
        hmr: {
            host: 'localhost',
            watch: {
                usePolling: true,
            },
        },
    },
})


