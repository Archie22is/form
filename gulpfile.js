var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    sassGlob = require('gulp-sass-glob'),
    sourcemaps = require('gulp-sourcemaps'),
    rename = require('gulp-rename'),
    livereload = require('gulp-livereload'),
    prefix = require('gulp-autoprefixer'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify');

gulp.task('scripts', function() {
    gulp.src('scripts/scripts.js')
    .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
    .pipe(uglify())
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('scripts'))
    .pipe(livereload());
});

gulp.task('styles', function() {
    gulp.src('styles/main.scss')
    .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
    .pipe(sourcemaps.init())
    .pipe(sassGlob())
    .pipe(sass({
        outputStyle: 'compressed'
    }))
    .pipe(prefix('last 2 versions'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('styles'))
    .pipe(livereload());
});

gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('styles/main.scss', ['styles']);
    gulp.watch('scripts/scripts.js', ['scripts']);
});

gulp.task('default', ['scripts', 'styles', 'watch']);
