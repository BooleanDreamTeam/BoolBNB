const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sourceMaps()
    .js("resources/js/click.js", "public/js")
    .sourceMaps()
    .js("resources/js/extranet.js", "public/js")
    .sourceMaps()
    .js("resources/js/input-validation.js", "public/js")
    .sourceMaps()
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/search.scss", "public/css")
    .sass("resources/sass/main.scss", "public/css")
    .sass("resources/sass/show.scss", "public/css")
    .sass("resources/sass/analitycs.scss", "public/css")
    .sass("resources/sass/sponsor.scss", "public/css")
    .sass("resources/sass/host/extranet.scss", "public/css");
