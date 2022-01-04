/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

var gulp = require("gulp"),
	sass = require("gulp-sass");


function compile() {
	return (
		gulp
			.src("scss/**/*.scss")
			.pipe(sass())
			.on("error", sass.logError)
			.pipe(gulp.dest("css"))
	);
}

function watch() {
	gulp.watch("scss/**/*.scss", compile);
}

exports.watch = watch;
exports.compile = compile;