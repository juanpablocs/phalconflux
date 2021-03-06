var gulp    = require('gulp'),
    gutil   = require('gulp-util'),
    uglify  = require('gulp-uglify'),
    stylus  = require('gulp-stylus'),
    concat  = require('gulp-concat-util'),
    jade    = require('gulp-jade'),
    coffee  = require('gulp-coffee'),
    glob    = require('glob'),
    notify = require('gulp-notify'),
    sourcemaps = require('gulp-sourcemaps'),
    rename  = require('gulp-rename');

var message = {}
    message.not_modified  = '/* This file is generated — do not edit by hand! */\n';
    message.finish_coffee = 'Finished minifying CoffeeScript';

var path = {
      src:{
        js      : {
                  origin  :'frontend/js/*.js',
                  destiny : 'backend/static/js'
        },
        stylus  : {
                  origin  : 'frontend/stylus/*.styl',
                  destiny : 'backend/static/css'
        },
        img     : {
                  origin  : 'frontend/img/*.*',
                  destiny : 'backend/static/img'
        },
        templates : {
                  origin  : 'frontend/templates/*.*',
                  destiny : 'backend/vendor/templates'
        },
        plugin1 : {
                  origin  : 'frontend/plugins/*/*.*',
                  destiny : 'backend/static/plugins'
        },
        plugin2 : {
                  origin  : 'frontend/plugins/*/*/*.*',
                  destiny : 'backend/static/plugins'
        },
      }
};

//compilando javascript
// gulp.task('js', function () {
// gulp.src(path.src.js.origin)
//         .pipe(uglify())
//         .pipe(concat('main.js'))
//         .pipe(gulp.dest(path.src.js.destiny));
// });
// //compilando img
// gulp.task('img', function() {
//   gulp.src(path.src.img.origin)
//    .pipe(gulp.dest(path.src.img.destiny));
// });


gulp.task('jade', function () {
  gulp.src('frontend/jade/modules/**/*.jade')
    .pipe(jade({
      pretty: true,
    }))
    .pipe(rename({extname: '.phtml'}))
    .pipe(concat.header("<!-- This file is generated4 — do not edit by hand! -->\n"))
    .pipe(gulp.dest('backend/views/modules/'));
});

gulp.task('coffee', function () {
  var modules = glob.sync('frontend/coffee/modules/*/');
      modules.forEach(function(folder)
      {
        var module = folder.match(/.+\/(.+)\/$/)[1];       
        gulp.src([folder + '*.coffee'])
          .pipe(coffee())
          .pipe(sourcemaps.init())
          .pipe(concat(module + '.min.js'))
          .pipe(uglify())
          .pipe(concat.header(message.coffee_not_modified))
          .pipe(sourcemaps.write('./'))
          .pipe(gulp.dest('public/static/js/'))
          .pipe(notify({ message: message.finish_coffee}));
      });
});

gulp.task('vendor', function () {
  var modules = glob.sync('frontend/coffee/modules/*/');
      modules.forEach(function(folder)
      {
        
      });
});


//compilando templates
gulp.task('templates', function() {
  gulp.src(path.src.templates.origin)
   .pipe(gulp.dest(path.src.templates.destiny));
});
//compilando plugins
// gulp.task('plugins', function() {
//   gulp.src(path.src.plugin1.origin)
//    .pipe(gulp.dest(path.src.plugin1.destiny));
//   gulp.src(path.src.plugin2.origin)
//    .pipe(gulp.dest(path.src.plugin2.destiny));
// });
// // compilando stylus
// gulp.task('stylus', function () {
//   gulp.src(path.src.stylus.origin)
//     .pipe(stylus({
//       compress: true
//     }))
//     .pipe(concat('main.css'))
//     .pipe(gulp.dest(path.src.stylus.destiny));
// });

// gulp.task('default', function(){
//   gulp.run(['js', 'img', 'plugins', 'templates', 'stylus']); 
// });

// gulp.task('watch', function () {
//   gulp.watch(path.src.js.origin, ['js']);
//   gulp.watch(path.src.stylus.origin, ['stylus']);
//   gulp.watch(path.src.img.origin, ['img']);
//   gulp.watch(path.src.templates.origin, ['templates']);
//   gulp.watch(path.src.plugin1.origin, ['plugins']);
//   gulp.watch(path.src.plugin2.origin, ['plugins']);
// });
