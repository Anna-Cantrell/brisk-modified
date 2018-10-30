// Require packages
var gulp = require('gulp');
var postcss = require('gulp-postcss');
var cssnext = require('postcss-cssnext');
var minify = require('gulp-minify-css');
var babelMinify = require('gulp-babel-minify');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');
var atImport = require("postcss-import")

// Do CSS things
gulp.task('css', function() {
	var plugins = [
		atImport(),
		cssnext()
	];
	return gulp.src('./style.css')
		.pipe(postcss(plugins))
		.pipe(minify({ keepBreaks: true }))
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('./'))
		.pipe(livereload());
});

// Do JS things
gulp.task('js', function() {
	return gulp.src('./functions.js')
		.pipe(babelMinify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('./'))
		.pipe(livereload());
});

// Watch things
gulp.task('watch', function() {
	livereload.listen();
	gulp.watch(['./style.css', './functions.js', './imports/**/*.css'], gulp.parallel('css', 'js'));
});

gulp.task('default', gulp.series(gulp.parallel('css', 'js'), 'watch'));
