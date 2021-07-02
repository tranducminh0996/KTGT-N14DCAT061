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

mix.js('resources/js/app.js', 'public/js').vue()
    .js('resources/js/cms/app.js', 'public/js/cms')
    .js('resources/assets/js/app-vue.js', 'public/js/cms')
    .js('resources/js/assert/athletic/athleticIndex.js', 'public/js')
    .js('resources/js/helper/helperImage.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/video.scss', 'public/css')
    .sass('resources/sass/news.scss', 'public/css')
    .sass('resources/sass/detail_news.scss', 'public/css')
    .sass('resources/sass/detail_video.scss', 'public/css')
    .sass('resources/sass/schedule.scss', 'public/css')
    .sass('resources/sass/leaderBoardMoney.scss', 'public/css')
    .sass('resources/sass/imageLibrary.scss', 'public/css')
    .sass('resources/sass/athletic.scss', 'public/css')

    .sass('resources/sass/cms/style_cms.scss', 'public/css')
    .sass('resources/sass/cms/banner_home.scss', 'public/css')
    .sass('resources/sass/cms/athletic_cms.scss', 'public/css')
    .sass('resources/sass/cms/ticket_cms.scss', 'public/css')
    .sass('resources/sass/cms/tour_cms.scss', 'public/css')
    .sass('resources/sass/cms/video_cms.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}
