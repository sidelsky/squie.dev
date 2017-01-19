//Directories
var vhost         = 'http://squie.dev/',
    theme         = 'squie',
    root          = './public',
    src           = './src',
    dest          = root + '/wp-content/themes/' + theme + '/assets/build',
    jsSrc         = [dest + '/app.js', '!' + dest + '/app.min.js'],
	cssSrc        = [dest + '/style.css', '!' + dest + '/style.min.css'];

// Gulp
var gulp = require('gulp');

// Non-gulp plugins
var path         = require('path'),
    source       = require('vinyl-source-stream'),
    browserSync  = require('browser-sync'),
    browserify   = require('browserify'),
    autoprefixer = require('autoprefixer'),
    csswring     = require('csswring');


// Gulp plugins
var postcss      = require('gulp-postcss'),
    sass         = require('gulp-sass'),
    sourcemaps   = require('gulp-sourcemaps'),
    concat       = require('gulp-concat'),
    jshint       = require('gulp-jshint'),
    notify       = require('gulp-notify'),
    please       = require('gulp-pleeease'),
    pngmin       = require('gulp-pngmin'),
    rename       = require('gulp-rename'),
    replace      = require('gulp-replace'),
    svgstore     = require('gulp-svgstore'),
    svgmin       = require('gulp-svgmin'),
    cheerio      = require('gulp-cheerio'),
    size         = require('gulp-filesize'),
    spritesmith  = require('gulp.spritesmith'),
    uglify       = require('gulp-uglify'),
    lost         = require('lost');

// JS Lint
gulp.task('lint', function() {
    return gulp.src(src + '/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Sass
gulp.task('sass', function() {
    var sassOptions = {
            errLogToConsole: true,
            outputStyle: 'expanded'
        },
        postProcessors = [
            lost,
            autoprefixer({
                browsers: ['last 10 version']
            }),
            csswring
        ];

    return gulp
        .src(src + '/sass/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass(sassOptions))
        .on('error', handleErrors)
        .pipe(gulp.dest(dest))
        .pipe(browserSync.reload({
            stream: true
        }))
        .pipe(rename('style.min.css'))
        .pipe(postcss(postProcessors))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dest));
});

//SVG Sprite
gulp.task('svgSprite', function () {
    return gulp
        .src(src + '/img/svgs/*.svg')
        .pipe(svgmin())
        .pipe(rename({prefix: 'shape-'}))
        .pipe(svgstore({inlineSvg: true}))
        .pipe(cheerio({
          run: function ($, file) {
              $('svg').attr('style', 'display:none');
          },
          parserOptions: { xmlMode: true }
        }))
        .pipe(rename('svg-sprite.svg'))
        .pipe(gulp.dest(dest));
});

//Create iconfont from all of the svgs in the svg folder
gulp.task('iconfont', function() {
  gulp.src([src + '/img/svgs/*.svg'])
  .pipe(iconfontCss({
    fontName: 'icon-font',
    targetPath: '../../../../../../../src/sass/_icons.scss',
    fontPath: 'fonts/'
  }))
  .pipe(iconfont({
    fontName: 'icon-font',
    normalize: true
  }))
  .pipe(gulp.dest(dest + '/fonts'));
});

//Browser sync
gulp.task('browserServe', ['watch'], function(done) {
    browserSync({
        open: true,
        port: 3000,
        notify: false,
        proxy: {
            target: vhost,
            middleware: function(req, res, next) {
                res.setHeader('Access-Control-Allow-Origin', '*');
                res.setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With');
                res.setHeader('Access-Control-Allow-Methods', 'GET, POST', 'OPTIONS');
                next();
            }
        },
    }, done);
});

//Minify JS
gulp.task('uglifyJs', function() {
    return gulp.src(jsSrc)
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(size())
        .pipe(gulp.dest(dest));
});

// Sprites - create PNG file
gulp.task('spriteBase', function () {
  var spriteData = gulp.src(src + '/img/pngs/*.png').pipe(spritesmith({
    retinaSrcFilter: [src + '/img/pngs/*@2x.png'],
    imgName: dest+'/sprite.png',
    retinaImgName: dest+'/sprite@2x.png',
    cssName: src+'/sass/_sprites.scss'
  }));
  return spriteData.pipe(gulp.dest('./'));
});

// Sprites - replace default path in SASS
gulp.task('spriteCss', ['spriteBase'], function () {
  return gulp.src(src+'/sass/_sprites.scss')
		.pipe(replace('../../public/wp-content/themes/' + theme + '/assets/build/', ''))
		.pipe(gulp.dest(src+'/sass/'));
});

// Sprites - quant it
gulp.task('sprite', ['spriteCss'], function() {
	return gulp.src(dest+'/*.png')
    .pipe(pngmin())
    .pipe(gulp.dest(dest));
});

//Default build task (browserify)
gulp.task('buildTask', function() {
    return browserify({
            //do your config here
            entries: src + '/js/app.js',
        })
        .bundle()
        .on('error', handleErrors)
        .pipe(source('app.js')) //this converts to stream
        //do all processing here.
        //like uglification and so on.
        .pipe(gulp.dest(dest))
        .pipe(browserSync.reload({
            stream: true
        }));
});

//Watch files for changes
gulp.task('watch', function() {
    gulp.watch(src + '/js/*.js', ['lint', 'buildTask']);
    gulp.watch(src + '/sass/**/*.scss', ['sass']);
    gulp.watch(src + '**/*.svg', ['svgSprite']);
    gulp.watch(root + '/wp-content/themes/' + theme +'/**/*.php').on('change', browserSync.reload);
});

//Notify us of any errors
var handleErrors = function() {
    var args = Array.prototype.slice.call(arguments);
    // Send error to notification center with gulp-notify
    notify.onError({
        title: "Compile Error",
        message: "<%= error %>"
    }).apply(this, args);
    // Keep gulp from hanging on this task
    this.emit('end');
};

//Production ready
gulp.task('build', ['uglifyJs', 'lint', 'sass', 'svgSprite']);

// Default Task
gulp.task('default', ['build', 'buildTask', 'browserServe']);
