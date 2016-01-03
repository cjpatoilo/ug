var gulp = require("gulp");

gulp.task("copy", function () {
  gulp.src("vendor/bower_components/milligram/dist/milligram.min.css")
  .pipe(gulp.dest("resources/assets/css/"));

  gulp.src("vendor/bower_components/normalize.css/normalize.css")
  .pipe(gulp.dest("resources/assets/css/"));

  gulp.src("vendor/bower_components/font-awesome/css/font-awesome.min.css")
  .pipe(gulp.dest("resources/assets/css/"));
});

gulp.task("default", ["copy"]);