const mix = require('laravel-mix');
require('mix-tailwindcss');
require('laravel-mix-purgecss');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind()
    .override(config => {
        config.module.rules.find(rule => rule.test.test('.svg')).exclude = /\.svg$/;

        config.module.rules.push({
            test: /\.svg$/,
            use: [
                {loader: 'html-loader'}
            ]
        })
    }).purgeCss({
    globs: [
        path.join(__dirname, 'node_modules/vue-wysiwyg/**/*.vue'),
    ],
})
