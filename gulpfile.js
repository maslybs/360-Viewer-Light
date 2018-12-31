let gulp = require('gulp'),
		plumber = require('gulp-plumber'), //show error on console
		cleanCSS = require('gulp-clean-css'),
		autoprefixer = require('gulp-autoprefixer'),
		minify = require('gulp-minify'),
		pump = require('pump'),
		rename = require('gulp-rename');

// uglify js
gulp.task('compress', function () {
	gulp.src(['data/assets/js/data.js'])
			.pipe(minify({
				ext        : {
					min: '.min.js'
				},
				ignoreFiles: ['.min.js']
			}))
			.pipe(gulp.dest('data/assets/js'));
});

gulp.task('minify-css', () => {
	return gulp.src('data/assets/css/data.css')
			.pipe(cleanCSS())
			.pipe(gulp.dest('data/assets/css/dist'));
});


//watcher
gulp.task('watch', function () {
	gulp.watch(['data/assets/css/*.css'], ['minify-css']);
	gulp.watch(['data/assets/js/*.js'], ['compress']);
});

gulp.task('default', ['watch']);
