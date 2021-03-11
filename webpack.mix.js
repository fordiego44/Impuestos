const mix = require('laravel-mix');

mix.js('resources/js/delivery/index_app.js', 'public/js/filter_parameter.js');
mix.js('resources/js/delivery/chat.js', 'public/js/chat.js');
mix.js('resources/js/delivery/store.js', 'public/js/store.js');
