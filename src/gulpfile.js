// REQUIRE GULP & PLUGINS
//----------------------------------------------
var gulp         = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync  = require('browser-sync').create(),
    cssnano      = require('gulp-cssnano'),
    notify       = require('gulp-notify'),
    sass         = require('gulp-sass'),
    sassdoc      = require('sassdoc');
    shell        = require('gulp-shell'),
    sourcemaps   = require('gulp-sourcemaps'),
    uglify       = require('gulp-uglify');

// CONFIGURATION
//----------------------------------------------
// Sass options
var sassOptions = {
  // outputStyle: 'expanded',
  errLogToConsole: true
};

// STYLES
//----------------------------------------------
gulp.task('styles', function () {
// Source
  gulp.src('sass/{,*/}*.{scss,sass}')
// Document
  // .pipe(sassdoc())
// Initialize sourcemaps
  .pipe(sourcemaps.init())
// Compile Sass
  .pipe(sass(sassOptions)).on('error', notify.onError(function (error) {
    return error.message;
  }))
// Autoprefix
  .pipe(autoprefixer(["last 1 version", "> 1%", "ie 8"]))
// Minify
 // .pipe(cssnano())
// Write sourcemaps
  .pipe(sourcemaps.write('./'))
// Output
  .pipe(gulp.dest('../css'))
})

// SCRIPTS
//----------------------------------------------
gulp.task('scripts', function () {
// Source
  gulp.src('js/**/*.js')
// Uglify
  .pipe(uglify())
// Output
  .pipe(gulp.dest('../js'))
});



// DRUSH
//----------------------------------------------
//gulp.task('drush', shell.task([
//  'drush cache-clear all'
//]))

// WATCH
//----------------------------------------------
gulp.task('watch', function() {
// Watch .scss,.sass files to run styles task.
  gulp.watch('sass/{,*/}*.{scss,sass}', ['styles']);
// Watch .js files to run scripts task.
  gulp.watch('js/**/*.js', ['scripts']);
// Watch .svg files to run images task.
//  gulp.watch('img/*.svg', ['images']);
// Watch php, inc and info file changes to run drush task.
//  gulp.watch('../**/*.{php,inc,info}', ['drush']);
});

// DEFAULT TASK: RUN BASIC TASKS AND WATCH
//----------------------------------------------
gulp.task('default', ['styles', 'scripts', 'watch']);

// SERVE TASK: BROWSER RELOAD ON STYLES CHANGE
//----------------------------------------------
gulp.task('serve', ['styles'], function() {
  browserSync.init({
    proxy: "localhost/raiz"
  })
  gulp.watch('sass/{,*/}*.{scss,sass}', ['styles']);
  gulp.watch('../css/*').on('change', browserSync.reload);
});
