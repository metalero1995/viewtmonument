const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
]);*/

// general resources
let public_js = 'public/js/';
let public_css = 'public/css/';
let public_vendor = 'public/vendors/'
let resource_sass = 'resources/sass/';
// Gentelella resources
let gentelella_home = 'node_modules/gentelella/';
let gentelella_vendor = gentelella_home + '/vendors/';


/*mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');*/
   mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
]);
mix.
    copy(gentelella_home + 'build/css/custom.min.css',
        public_vendor + 'build/css/custom.min.css').
    copy(gentelella_home + 'build/js/custom.min.js',
        public_vendor + 'build/js/custom.min.js').        
    copy(gentelella_vendor + 'font-awesome/css/font-awesome.min.css',
        public_vendor + 'font-awesome/css/font-awesome.min.css').
    copy(gentelella_vendor + 'font-awesome/fonts/',
        public_vendor + 'font-awesome/fonts').               
    copy(gentelella_vendor + 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
        public_vendor + 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css').
    copy(gentelella_vendor + 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        public_vendor + 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js').
    copy(gentelella_vendor + 'jquery/dist/jquery.min.js',
        public_vendor + 'jquery/dist/jquery.min.js').    
    copy(gentelella_vendor + 'bootstrap/dist/css/bootstrap.min.css',
        public_vendor + 'bootstrap/dist/css/bootstrap.min.css').
    copy(gentelella_vendor + 'bootstrap/dist/fonts/',
        public_vendor + 'bootstrap/dist/fonts/').
    copy(gentelella_vendor + 'bootstrap/fonts/',
        public_vendor + 'bootstrap/fonts/').                
    copy(gentelella_vendor + 'bootstrap/dist/js/bootstrap.min.js',
        public_vendor + 'bootstrap/dist/js/bootstrap.min.js').
    copy(gentelella_vendor + 'fastclick/lib/fastclick.js',
        public_vendor + 'fastclick/lib/fastclick.js').
    copy(gentelella_vendor + 'iCheck/skins/flat/green.css',
        public_vendor + 'iCheck/skins/flat/green.css').
    copy(gentelella_vendor + 'iCheck/icheck.min.js',
        public_vendor + 'iCheck/icheck.min.js').
    copy(gentelella_vendor + 'bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        public_vendor + 'bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css').
    copy(gentelella_vendor + 'bootstrap-progressbar/bootstrap-progressbar.min.js',
        public_vendor + 'bootstrap-progressbar/bootstrap-progressbar.min.js').        
    copy(gentelella_vendor + 'jqvmap/dist/jqvmap.min.css',
        public_vendor + 'jqvmap/dist/jqvmap.min.css').
    copy(gentelella_vendor + 'jqvmap/dist/jquery.vmap.js',
        public_vendor + 'jqvmap/dist/jquery.vmap.js').
    copy(gentelella_vendor + 'bootstrap-daterangepicker/daterangepicker.css',
        public_vendor + 'bootstrap-daterangepicker/daterangepicker.css').
    copy(gentelella_vendor + 'bootstrap-daterangepicker/daterangepicker.js',
        public_vendor + 'bootstrap-daterangepicker/daterangepicker.js').
    copy(gentelella_vendor + 'animate.css/animate.min.css',
        public_vendor + 'animate.css/animate.min.css').
    copy(gentelella_vendor + 'nprogress/nprogress.css',
        public_vendor + 'nprogress/nprogress.css').
    copy(gentelella_vendor + 'nprogress/nprogress.js',
        public_vendor + 'nprogress/nprogress.js').        
    copy(gentelella_vendor + 'google-code-prettify/bin/prettify.min.css',
        public_vendor + 'google-code-prettify/bin/prettify.min.css').
    copy(gentelella_vendor + 'select2/dist/css/select2.min.css',
        public_vendor + 'select2/dist/css/select2.min.css').
    copy(gentelella_vendor + 'switchery/dist/switchery.min.css',
        public_vendor + 'switchery/dist/switchery.min.css').
    copy(gentelella_vendor + 'starrr/dist/starrr.css',
        public_vendor + 'starrr/dist/starrr.css').
    copy(gentelella_vendor + 'starrr/dist/starrr.js',
        public_vendor + 'starrr/dist/starrr.js').        
    copy(gentelella_vendor + 'moment/min/moment.min.js',
        public_vendor + 'moment/min/moment.min.js').
    copy(gentelella_vendor + 'bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
        public_vendor + 'bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js').
    copy(gentelella_vendor + 'jquery.hotkeys/jquery.hotkeys.js',
        public_vendor + 'jquery.hotkeys/jquery.hotkeys.js').
    copy(gentelella_vendor + 'google-code-prettify/src/prettify.js',
        public_vendor + 'google-code-prettify/src/prettify.js').
    copy(gentelella_vendor + 'jquery.tagsinput/src/jquery.tagsinput.js',
        public_vendor + 'jquery.tagsinput/src/jquery.tagsinput.js').
    copy(gentelella_vendor + 'switchery/dist/switchery.min.js',
        public_vendor + 'switchery/dist/switchery.min.js').        
    copy(gentelella_vendor + 'select2/dist/js/select2.full.min.js',
        public_vendor + 'select2/dist/js/select2.full.min.js').
    copy(gentelella_vendor + 'parsleyjs/dist/parsley.min.js',
        public_vendor + 'parsleyjs/dist/parsley.min.js').        
    copy(gentelella_vendor + 'autosize/dist/autosize.min.js',
        public_vendor + 'autosize/dist/autosize.min.js').
    copy(gentelella_vendor + 'devbridge-autocomplete/dist/jquery.autocomplete.min.js',
        public_vendor + 'devbridge-autocomplete/dist/jquery.autocomplete.min.js').
    copy(gentelella_vendor + 'datatables.net-bs/css/dataTables.bootstrap.min.css',
        public_vendor + 'datatables.net-bs/css/dataTables.bootstrap.min.css').
    copy(gentelella_vendor + 'datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
        public_vendor + 'datatables.net-buttons-bs/css/buttons.bootstrap.min.css'). 
    copy(gentelella_vendor + 'datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
        public_vendor + 'datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'). 
    copy(gentelella_vendor + 'datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
        public_vendor + 'datatables.net-responsive-bs/css/responsive.bootstrap.min.css'). 
    copy(gentelella_vendor + 'datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
        public_vendor + 'datatables.net-scroller-bs/css/scroller.bootstrap.min.css').
    copy(gentelella_vendor + 'datatables.net/js/jquery.dataTables.min.js',
        public_vendor + 'datatables.net/js/jquery.dataTables.min.js').
    copy(gentelella_vendor + 'datatables.net-bs/js/dataTables.bootstrap.min.js',
        public_vendor + 'datatables.net-bs/js/dataTables.bootstrap.min.js').
    copy(gentelella_vendor + 'datatables.net-buttons/js/dataTables.buttons.min.js',
        public_vendor + 'datatables.net-buttons/js/dataTables.buttons.min.js').
    copy(gentelella_vendor + 'datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
        public_vendor + 'datatables.net-buttons-bs/js/buttons.bootstrap.min.js').
    copy(gentelella_vendor + 'datatables.net-buttons/js/buttons.flash.min.js',
        public_vendor + 'datatables.net-buttons/js/buttons.flash.min.js').
    copy(gentelella_vendor + 'datatables.net-buttons/js/buttons.html5.min.js',
        public_vendor + 'datatables.net-buttons/js/buttons.html5.min.js').
    copy(gentelella_vendor + 'datatables.net-buttons/js/buttons.print.min.js',
        public_vendor + 'datatables.net-buttons/js/buttons.print.min.js').
    copy(gentelella_vendor + 'datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
        public_vendor + 'datatables.net-fixedheader/js/dataTables.fixedHeader.min.js').
    copy(gentelella_vendor + 'datatables.net-keytable/js/dataTables.keyTable.min.js',
        public_vendor + 'datatables.net-keytable/js/dataTables.keyTable.min.js').
    copy(gentelella_vendor + 'datatables.net-responsive/js/dataTables.responsive.min.js',
        public_vendor + 'datatables.net-responsive/js/dataTables.responsive.min.js').
    copy(gentelella_vendor + 'datatables.net-responsive-bs/js/responsive.bootstrap.js',
        public_vendor + 'datatables.net-responsive-bs/js/responsive.bootstrap.js').
    copy(gentelella_vendor + 'datatables.net-scroller/js/dataTables.scroller.min.js',
        public_vendor + 'datatables.net-scroller/js/dataTables.scroller.min.js').
    copy(gentelella_vendor + 'jszip/dist/jszip.min.js',
        public_vendor + 'jszip/dist/jszip.min.js').
    copy(gentelella_vendor + 'pdfmake/build/pdfmake.min.js',
        public_vendor + 'pdfmake/build/pdfmake.min.js').
    copy(gentelella_vendor + 'bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        public_vendor + 'bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css').
    copy(gentelella_vendor + 'bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        public_vendor + 'bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js').
    copy(gentelella_vendor + 'mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css',
        public_vendor + 'mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css').
    copy(gentelella_vendor + 'Chart.js/dist/Chart.min.js',public_vendor + 'Chart.js/dist/Chart.min.js').
    copy(gentelella_vendor + 'normalize-css/normalize.css',public_vendor + 'normalize-css/normalize.css').
    copy(gentelella_vendor + 'Chart.js/dist/Chart.min.js',public_vendor + 'Chart.js/dist/Chart.min.js').
    copy(gentelella_vendor + 'ion.rangeSlider/css/ion.rangeSlider.css',public_vendor + 'ion.rangeSlider/css/ion.rangeSlider.css').
    copy(gentelella_vendor + 'ion.rangeSlider/css/ion.rangeSlider.skinFlat.css',public_vendor + 'ion.rangeSlider/css/ion.rangeSlider.skinFlat.css').
    copy(gentelella_vendor + 'ion.rangeSlider/js/ion.rangeSlider.min.js',public_vendor + 'ion.rangeSlider/js/ion.rangeSlider.min.js').
    copy(gentelella_vendor + 'cropper/dist/cropper.min.css',public_vendor + 'cropper/dist/cropper.min.css').
    copy(gentelella_vendor + 'cropper/dist/cropper.min.js',public_vendor + 'cropper/dist/cropper.min.js').
    copy(gentelella_vendor + 'fastclick/lib/fastclick.js',public_vendor + 'fastclick/lib/fastclick.js').
    copy(gentelella_vendor + 'starrr/dist/starrr.css',public_vendor + 'starrr/dist/starrr.css').
    copy(gentelella_vendor + 'starrr/dist/starrr.js',public_vendor + 'starrr/dist/starrr.js');