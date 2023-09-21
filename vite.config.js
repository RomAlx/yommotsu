import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';

const host = 'yommotsu.com';

export default defineConfig({
    //dev
    //server: {
    //       hmr: {
    //    host: `localhost`
    //    }
    //},
    //prod
    //server: {
    //    host,
    //    hmr: { host },
    //    https: {
    //        key: fs.readFileSync(`/etc/ssl/yommotsu.key`),
    //        cert: fs.readFileSync(`/etc/ssl/yommotsu.crt`),
    //    }
    //},
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});