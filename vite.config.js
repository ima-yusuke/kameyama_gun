import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            registerType: 'autoUpdate',
            includeAssets: ['/robots.txt'],
            manifest: {
                name: '亀山銃砲火薬店',
                short_name: '亀山銃砲',
                description: '亀山銃砲火薬店の商品閲覧アプリ',
                theme_color: '#ffffff',
                lang: 'ja',
                start_url: '/',
                scope: '/',
                display: 'standalone',
                icons: [
                    {
                        src: '/storage/img/logo_1_white.png',
                        sizes: '192x192',
                        type: 'image/png'
                    },
                    {
                        src: '/storage/img/logo_1_white.png',
                        sizes: '512x512',
                        type: 'image/png'
                    }
                ]
            },
            workbox: {
                cleanupOutdatedCaches: true,
                skipWaiting: true,
                clientsClaim: true,
                navigateFallback: '/',
                runtimeCaching: [
                    {
                        urlPattern: /^https:\/\/kameyama-guns\.mie-projectm\.com\/.*\.(?:css|js)$/,
                        handler: 'NetworkFirst',
                        options: {
                            cacheName: 'kameyama-guns-assets-v1',
                            expiration: {
                                maxEntries: 100,
                                maxAgeSeconds: 60 // 1 minute
                            }
                        }
                    },
                ]
            }
        }),
    ],
    server: {
        //ローカル環境では不要
        // https: true,
    },
    build: {
        manifest: 'manifest.json',
        rollupOptions: {
            input: {
                appCss: 'resources/css/app.css',
                app: 'resources/js/app.js'
            }
        }
    }
});
