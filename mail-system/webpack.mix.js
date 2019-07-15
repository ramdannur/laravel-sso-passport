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

mix.copy('resources/assets/css/app.css', 'public/css/app.css');
mix.copy('resources/assets/js/app.js', 'public/js/app.js');
mix.copyDirectory('node_modules/admin-lte/plugins/bootstrap-wysihtml5', 'public/plugins/bootstrap-wysihtml5');
mix.copyDirectory('resources/assets/img', 'public/img');
