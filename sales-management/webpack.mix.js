let mix = require('laravel-mix');

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

mix.js('resources/assets/js/admin-lte.js', 'public/js/admin')
.sass('resources/assets/sass/admin-lte.scss', 'public/css/admin');

mix.js('resources/assets/js/bootstrap.js', 'public/js/')
.sass('resources/assets/sass/bootstrap.scss', 'public/css/');

mix.copyDirectory('resources/assets/frontend/css', 'public/css');
mix.copyDirectory('resources/assets/frontend/js', 'public/js');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('node_modules/admin-lte/plugins/input-mask', 'public/plugins/input-mask');
mix.copyDirectory('resources/assets/images', 'public/images');
