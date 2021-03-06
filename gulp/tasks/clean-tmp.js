/*

Clears out tmp folder

*/
import gulp from 'gulp';
import config from '../config';
import del from 'del';

gulp.task('clean:tmp', done => {

  return del([
    config.folders.tmp
  ], { force: true });

});
