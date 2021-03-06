const mix = require('laravel-mix');

const webpack = require('webpack');
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

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            '$': 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
        }),
    ]
});

mix.js('resources/js/app.js', 'public/js')
    .js([
        'resources/js/frontend/index.js',
    ], 'public/js/frontend.js')
    .vue()
    .sass('resources/sass/main.scss', 'public/css');
