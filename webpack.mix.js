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

// * Apps
mix.js('resources/js/app.js', 'public/build/js')
  .sass('resources/sass/app.scss', 'public/build/css')

// * Tailwind
  .postCss("resources/css/tailwind.css", "public/build/css", [
    require("tailwindcss"),
  ]);