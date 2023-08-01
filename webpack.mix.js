const mix = require('laravel-mix');

mix.styles('resources/css/bootstrap.min.css')
   .styles('resources/css/animate.css')
   .styles('resources/css/all.min.css')
   .styles('resources/css/font-awesome.min.css')
   .styles('resources/css/style.css')
   .js('resources/js/jquery-3.6.0.min.js')
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
