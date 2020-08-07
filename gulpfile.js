/*
*
* JUST FOR RELOADING / WATCHING AND BROWSERSYNC 
*
*/
var gulp        = require('gulp');
// var browser = require('browser-sync').create();
var browserSync = require('browser-sync');//.create();
// const babel = require('gulp-babel');
// var webpack = require('webpack');
// var webpack = require('webpack-stream');
// const named = require('vinyl-named');


const LOCALSERVER = "http://larslo.larslo/liaison/";
const PORT = 8000;

// Start a server with BrowserSync to preview the site in
// function server() {
  gulp.task('browser-sync', function() {
    browserSync.create();
    browserSync.init({
      proxy: LOCALSERVER, 
      port: PORT
    });
  });

// Watch for changes to static assets, pages, Sass, and JavaScript
// function watch() {
  gulp.task('watch', function() {
  // gulp.watch(PATHS.assets, copy);
  // gulp.watch('./addons/*.html').on('change', browserSync.reload);
  // gulp.watch('assets/images/svg/*').on('change', browserSync.reload);
  gulp.watch('./assets/css/*.css').on('change', browserSync.reload);
  // gulp.watch('./addons/*.scss').on('change', browserSync.reload);
  gulp.watch('./assets/js/*.js').on('change', browserSync.reload);
  // gulp.watch('./larslo/*.js').on('change', browserSync.reload);
  // gulp.watch('../../mu-plugins/**/*.php').on('change', browserSync.reload);
  // gulp.watch('*.html').on('all', gulp.series(pages, browser.reload));
  // gulp.watch('src/{layouts,partials}/**/*.html').on('all', gulp.series(resetPages, pages, browser.reload));
  // gulp.watch('assets/styles/style.css').on('change', browserSync.reload);
  // gulp.watch('assets/scripts/script.bundle.js').on('change', browserSync.reload);

  // gulp.watch('../../plugins/larslo1block/dist/*.js').on('change', browserSync.reload);
  // gulp.watch('assets/scripts/animation/*.js').on('change', browserSync.reload);
  gulp.watch('./app/**/*.php').on('change', browserSync.reload);
  // gulp.watch('src/styleguide/**').on('all', gulp.series(styleGuide, browser.reload));
  // 
  // point to block-builder-dist
  // gulp.watch('../../plugins/larslo-block-builder/assets/js/*.js').on('change', browserSync.reload);
  // gulp.watch('../../plugins/larslo-block-builder/assets/css/*.css').on('change', browserSync.reload);
  // 
});

  // const minify = require('gulp-minify');
  // var gulp_remove_logging = require("gulp-remove-logging");

 

gulp.task('default',  gulp.parallel("browser-sync", "watch"));