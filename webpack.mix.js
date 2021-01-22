const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js('resources/js/app.js', 'public/js')
  .copyDirectory('node_modules/ckeditor4', 'public/js/plugins/ckeditor4')
  .copyDirectory(
    'node_modules/@fortawesome/fontawesome-free/webfonts',
    'public/webfonts'
  )
  .js('resources/js/pages/products/index.js', 'public/js/pages/products/')
  .js('resources/js/pages/products/create.js', 'public/js/pages/products/')
  .js('resources/js/pages/products/edit.js', 'public/js/pages/products/')
  .sass('resources/scss/app.scss', 'public/css');

if (mix.inProduction()) {
  mix.version();
}
