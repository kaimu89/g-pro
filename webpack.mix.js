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

mix.browserSync('homestead.test')
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')



   .sass('resources/sass/addedPlayer.scss', 'public/css')
   .sass('resources/sass/add.scss', 'public/css')
   .sass('resources/sass/auth.scss', 'public/css')
   .sass('resources/sass/confirm.scss', 'public/css')
   .sass('resources/sass/contact.scss', 'public/css')
   .sass('resources/sass/entry.scss', 'public/css')
   .sass('resources/sass/explain.scss', 'public/css')
   .sass('resources/sass/findteam.scss', 'public/css')
   .sass('resources/sass/game.scss', 'public/css')
   .sass('resources/sass/index.scss', 'public/css')
   .sass('resources/sass/log.scss', 'public/css')
   .sass('resources/sass/nomal.scss', 'public/css')
   .sass('resources/sass/player.scss', 'public/css')
   .sass('resources/sass/recruit.scss', 'public/css')
   .sass('resources/sass/standard.scss', 'public/css')
   .sass('resources/sass/team.scss', 'public/css')
   .sass('resources/sass/profileShow.scss', 'public/css')
   .sass('resources/sass/profileEdit.scss', 'public/css')
   .sass('resources/sass/myteamShow.scss', 'public/css')
   .sass('resources/sass/myteamEdit.scss', 'public/css')
   .sass('resources/sass/try.scss', 'public/css')
   .sass('resources/sass/myplayerShow.scss', 'public/css')
   .sass('resources/sass/myplayerEdit.scss', 'public/css')
   .sass('resources/sass/notice.scss', 'public/css')
   .version();