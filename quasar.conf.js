// Configuration for your app

module.exports = function (ctx) {
    return {
        preFetch: true,
        // app boot file (/src/boot)
        // --> boot files are part of "main.js"
        boot: [
            'i18n',
            'axios',
            'moment',
            'vee_validate',
            'json_excel',
            'collect',
            'ability',
            'global_filters'
        ],

        css: [
            'app.scss'
        ],

        extras: [
            'roboto-font',
            'material-icons', // optional, you are not bound to it
            // 'ionicons-v4',
            // 'mdi-v3',
            'fontawesome-v5',
            // 'eva-icons'
        ],

        framework: {
            all: true, // --- includes everything; for dev only!

            components: [],

            directives: [],

            // Quasar plugins
            plugins: [
                'Notify',
                'Cookies',
                'Meta',
                'LocalStorage',
                'SessionStorage',
                'Loading'
            ],

            cssAddon: true,


            // iconSet: 'ionicons-v4'
            // lang: 'de' // Quasar language
        },

        supportIE: false,

        build: {
            scopeHoisting: true,
            vueRouterMode: 'hash',
            // vueCompiler: true,
            // gzip: true,
            // analyze: true,
            distDir: 'public/app',
            // publicPath: '/app/',
            // extractCSS: false,
            extendWebpack(cfg) {
                // cfg.module.rules.push({
                //     enforce: 'pre',
                //     test: /\.(js|vue)$/,
                //     loader: 'eslint-loader',
                //     exclude: /node_modules/
                // })

                if (ctx.prod) {
                    cfg.output.publicPath = '/public/app/'
                }

                if (cfg.output) {
                    const CopyWebpackPlugin = require("copy-webpack-plugin");
                    cfg.plugins.push(
                        new CopyWebpackPlugin([
                            {
                                from: ".htaccess",
                                to: cfg.output.path
                            }
                        ])
                    );
                }
            }
        },

        devServer: {
            // https: true,
            // port: process.env.PORT | 8080,
            host: process.env.HOST | 'localhost',
            open: true // opens browser window automatically,
        },

        // animations: 'all', // --- includes all animations
        animations: [
            'bounce'
        ],

        ssr: {
            pwa: false
        },

        pwa: {
            // workboxPluginMode: 'InjectManifest',
            // workboxOptions: {}, // only for NON InjectManifest
            manifest: {
                // name: 'Quasar App',
                // short_name: 'Quasar-PWA',
                // description: 'Best PWA App in town!',
                display: 'standalone',
                orientation: 'portrait',
                background_color: '#ffffff',
                theme_color: '#027be3',
                icons: [
                    {
                        'src': 'statics/icons/icon-128x128.png',
                        'sizes': '128x128',
                        'type': 'image/png'
                    },
                    {
                        'src': 'statics/icons/icon-192x192.png',
                        'sizes': '192x192',
                        'type': 'image/png'
                    },
                    {
                        'src': 'statics/icons/icon-256x256.png',
                        'sizes': '256x256',
                        'type': 'image/png'
                    },
                    {
                        'src': 'statics/icons/icon-384x384.png',
                        'sizes': '384x384',
                        'type': 'image/png'
                    },
                    {
                        'src': 'statics/icons/icon-512x512.png',
                        'sizes': '512x512',
                        'type': 'image/png'
                    }
                ]
            }
        },

        cordova: {
            // id: 'org.cordova.app.app'
            // noIosLegacyBuildFlag: true // uncomment only if you know what you are doing
        },

        electron: {
            // bundler: 'builder', // or 'packager'

            extendWebpack(cfg) {
                // do something with Electron main process Webpack cfg
                // chainWebpack also available besides this extendWebpack
            },

            packager: {
                // https://github.com/electron-userland/electron-packager/blob/master/docs/api.md#options

                // OS X / Mac App Store
                // appBundleId: '',
                // appCategoryType: '',
                // osxSign: '',
                // protocol: 'myapp://path',

                // Window only
                // win32metadata: { ... }
            },

            builder: {
                // https://www.electron.build/configuration/configuration

                // appId: 'app-app'
            }
        }
    }
}
