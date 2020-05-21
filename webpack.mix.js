const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');


mix.scripts([
	'resources/assets/backend/bower_components/jquery/dist/jquery.min.js',
	'resources/assets/backend/bower_components/jquery-ui/jquery-ui.min.js',
    'resources/assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/backend/bower_components/select2/dist/js/select2.full.min.js',
    'resources/assets/backend/bower_components/raphael/raphael.min.js',
    'resources/assets/backend/bower_components/morris.js/morris.min.js',
    'resources/assets/backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
    'resources/assets/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    'resources/assets/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    'resources/assets/backend/bower_components/jquery-knob/dist/jquery.knob.min.js',
    'resources/assets/backend/bower_components/moment/min/moment.min.js',
    'resources/assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'resources/assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    'resources/assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
    'resources/assets/backend/bower_components/fastclick/lib/fastclick.js',
    'resources/assets/backend/dist/js/adminlte.min.js',
    'resources/assets/backend/dist/js/pages/dashboard.js',
    'resources/assets/backend/plugins/iCheck/icheck.min.js',
    'resources/assets/backend/dist/js/sweetalert.min.js',
    'resources/assets/backend/dist/js/demo.js'
], 'public/backend/js/app.js');



mix.styles([
    'resources/assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css',
    'resources/assets/backend/bower_components/font-awesome/css/font-awesome.min.css',
    'resources/assets/backend/bower_components/Ionicons/css/ionicons.min.css',
    'resources/assets/backend/dist/css/skins/_all-skins.min.css',
    'resources/assets/backend/bower_components/morris.js/morris.css',
    'resources/assets/backend/bower_components/jvectormap/jquery-jvectormap.css',
    'resources/assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'resources/assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css',
    'resources/assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    'resources/assets/backend/plugins/iCheck/square/blue.css',
    'resources/assets/backend/bower_components/select2/dist/css/select2.min.css',
    'resources/assets/backend/dist/css/sweetalert.css',
    'resources/assets/backend/dist/css/AdminLTE.css',
    'resources/assets/backend/style.css',
], 'public/backend/css/app.css');
