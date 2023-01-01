import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs'

export default defineConfig({
    plugins: [
        // Add it first
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        // Workaround to fix error:
        // Can't find stylesheet to import. @import '~admin-lte/build/scss/adminlte';
        // https://github.com/vitejs/vite/issues/5764
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
            },
        ],
    },
    optimizeDeps: {
        esbuildOptions: {
            plugins: [
                esbuildCommonjs(['jquery', 'jquery-ui-dist/jquery-ui'])
            ]
        }
    }
});
