const gulp        = require('gulp');
const browserSync = require('browser-sync').create();

//gulp.task('server', function() {
//    browserSync.init({
//        server: {
//            baseDir: "build"
//        }
//    });
//    
//    gulp.watch('build/**/*').on('change', browserSync.reload);
//});