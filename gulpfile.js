var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        'ecograph-bootstrap.css',
        'iconFont.css',
        'ecograph.css'
    ], 'public/css/main.css');

    mix.scripts([
        'geolocalizacao.js',
        'jquery.ui.map.full.min.js'
    ], 'public/js/alljs.js');

    mix.scripts(['geral.js'],
        'public/js/custom.js');

    mix.version(['css/main.css','js/alljs.js','js/custom.js' ]);
    mix.copy('resources/assets/fonts','public/build/fonts');

});
