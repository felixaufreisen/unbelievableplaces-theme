// gulp.js einbauen
var gulp = require('gulp');

// Plugins einbauen
var plumber = require('gulp-plumber'),
    jshint = require ('gulp-jshint'),
    concat = require ('gulp-concat'),
    uglify = require ('gulp-uglify'),
    sass = require('gulp-sass'),
    autoprefixer = require ('gulp-autoprefixer'),
    cleanCSS = require ('gulp-clean-css')

function css() {
  return gulp.src([
      'sass/style.scss'
    ])
    .pipe(plumber())
    .pipe(sass())
    .pipe(autoprefixer({
      cascade: false
    }))
    .pipe(cleanCSS())
    .pipe(gulp.dest('./'));
}

function js_uglify() {
  return gulp.src([
      'node_modules/jquery/dist/jquery.slim.js',
      'node_modules/popper.js/dist/umd/popper.js',
      'node_modules/bootstrap/dist/js/bootstrap.js',
      // 'node_modules/d3/d3.min.js', // benötigt für datamaps
      'node_modules/topojson/build/topojson.js', // benötigt für datamaps
      'node_modules/datamaps/dist/datamaps.world.js',
      'node_modules/@google/markerclusterer/src/markerclusterer.js',
      'node_modules/@fortawesome/fontawesome-free/js/fontawesome.js',
      'node_modules/@fortawesome/fontawesome-free/js/brands.js',
      // 'node_modules/@fortawesome/fontawesome-free/js/solid.js', // Symbole manuell eingefügt, um Dateigröße zu reduzieren
      'js/*.js',
      '!js/customizer.js',
      '!js/infobox.js', // Muss nach Google-API eingebunden werden
      '!js/script.min.js'
    ])
    .pipe(plumber())
    .pipe(jshint())
    .pipe(concat('temp.min.js'))
    .pipe(uglify())  //d3 funktiniert dann nicht mehr
    .pipe(gulp.dest('./js/'));
}

// d3 schmeißt nach uglify einen Fehler. Deshalb wird es ohne uglify eingebunden
function js_add_d3() {
  return gulp.src([
      'node_modules/d3/d3.min.js', // benötigt für datamaps
      'js/temp.min.js'
    ])
    .pipe(plumber())
    .pipe(jshint())
    .pipe(concat('script.min.js'))
    .pipe(gulp.dest('./js/'));
}

// Gebündelte Aufgaben definieren
var js = gulp.series( js_uglify, js_add_d3 );
var build = gulp.parallel( css, js );

function watch() {
  gulp.watch('sass/**/*.scss', css)
  gulp.watch(['js/*.js', '!js/script.min.js'], js)
}

// Tasks definieren
gulp.task('css', css);

gulp.task('js', js);

gulp.task('build', build);

gulp.task('watch', watch);
