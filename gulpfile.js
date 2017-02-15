var gulp = require('gulp');
var stylus = require('gulp-stylus');
var please = require('gulp-pleeease');
var minify = require('gulp-minify');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('styl', function () {
    gulp.src('./stylus/*.styl')
        .pipe(sourcemaps.init())
        .pipe(stylus())
        .pipe(sourcemaps.write())
        .pipe(please({   autoprefixer: {
            "browsers": ["last 4 versions", "ios 6"]
        }}))
        .pipe(gulp.dest('./css/build/'));
});

gulp.task('default', ['styl'], function () {
    gulp.watch('./stylus/**/*.styl', ['styl']);
});