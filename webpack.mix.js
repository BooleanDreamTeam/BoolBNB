const mix = require('laravel-mix');

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

mix.js('resources/js/main.js', 'public/js')
    .js('resources/js/search.js', 'public/js')
    .js('resources/js/show.js', 'public/js')
    .js('resources/js/analitycs.js', 'public/js')
    .js('resources/js/sponsor.js', 'public/js')
    .sass('resources/sass/search.scss', 'public/css')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/show.scss', 'public/css')
    .sass('resources/sass/analitycs.scss', 'public/css')
    .sass('resources/sass/sponsor.scss', 'public/css');

