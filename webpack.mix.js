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
mix.js('resources/js/apps/auth', 'public/build/js')
  .sass('resources/sass/apps/auth/styles.scss', 'public/build/css/auth.css')

  .js('resources/js/apps/catalog', 'public/build/js')
  .sass('resources/sass/apps/catalog/styles.scss', 'public/build/css/catalog.css')

  .js('resources/js/apps/panel', 'public/build/js')
  .sass('resources/sass/apps/panel/styles.scss', 'public/build/css/panel.css')

// * Tailwind
  .postCss("resources/css/tailwind.css", "public/build/css", [
    require("tailwindcss"),
  ]);