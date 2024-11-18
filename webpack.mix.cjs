let mix = require('laravel-mix');
mix.ts("resources/js/app.tsx", "public/js").react();
mix.css("resources/css/app.css", "public/css");