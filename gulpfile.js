// gulp.js einbauen
var gulp = require('gulp');

// Plugins einbauen
var plumber = require('gulp-plumber'),
    jshint = require ('gulp-jshint'),
    concat = require ('gulp-concat'),
    uglify = require ('gulp-uglify'),
    sass = require('gulp-sass')
    autoprefixer = require ('gulp-autoprefixer'),
    cleanCSS = require ('gulp-clean-css');

gulp.task('css', function() {
  return gulp.src('sass/style.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(gulp.dest('./'))
});

gulp.task('js', function() {
  return gulp.src([
      'node_modules/jquery/dist/jquery-3.3.1.slim.js',
      'node_modules/bootstrap/dist/js/bootstrap.js',
      'node_modules/js-marker-clusterer/src/markerclusterer.js',
      'js/map.js',
      'js/*.js',
      '!js/customizer.js',
      '!js/infobox.js', // Muss nach Google-API eingebunden werden
      '!js/script.min.js'
    ])
    .pipe(plumber())
    .pipe(jshint())
    .pipe(concat('script.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./js/'))
});

gulp.task('build', gulp.parallel( 'css', 'js' ));

gulp.task('watch', function() {
  gulp.watch('sass/**/*.scss', gulp.series( 'css' ))
  gulp.watch(['js/*.js', '!js/customizer.js', '!js/script.min.js'], gulp.series( 'js' ))
});
