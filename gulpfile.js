// Static resources
var gulp = require('gulp');
var exec = require('child_process').exec;
var notify = require("gulp-notify");
var gutil = require('gulp-util');

// Elixir
var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

// Test function
var phpunit_bin = /^win/.test(process.platform) ? 'vendor\\bin\\phpunit.bat' : './vendor/bin/phpunit';

function phpunit(unit_test_path) {
    unit_test_path = typeof unit_test_path !== 'undefined' ? unit_test_path : '';

    console.log('\n$ phpunit ' + unit_test_path + '\n');

    exec(phpunit_bin + ' ' + unit_test_path, function(error, stdout, stderr) {
        console.log('\n' + stdout);
        if (! error) {
            console.log(gutil.colors.bgGreen( Array(108).join(' ')) );
        } else {
            // console.log('\nERROR: ' + error);
            console.log(gutil.colors.bgRed( Array(108).join(' ')) );
        }
        console.log(Array(108).join('=') + '\n');
    });
}

// Single test
gulp.task('phpunit', function(a) {
    console.log(a);
    phpunit();
});

// Continuous testing
gulp.task('tdd', function() {
    var test_watcher = gulp.watch('tests/**/*.php', { debounceDelay: 1000 });
    test_watcher.on('change', function(event){
        phpunit( event.path.replace(/\\/g, '/') );
    });

    var app_watcher = gulp.watch('app/**/*.php', { debounceDelay: 1000 });
    app_watcher.on('change', function(event){
        phpunit( event.path.replace(/\\/g, '/').replace('/app/', '/tests/').replace(/.php$/, 'Test.php') );
    });
});
