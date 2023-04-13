<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ViewTMonument</title>



  <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
<script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>
<link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet" />


  <!--Icon-->
  <link rel="icon" type="image/x-icon" href="{{asset ('../resources/img/Isotipo_cerceta.ico') }}">
      <link rel="stylesheet" href="{{asset ('../resources/css/inicio.css')}}">

  <link href="{{asset ('../resources/css/monumentos.css') }}" rel="stylesheet"> 


  <!-- Bootstrap 
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">-->
  
  <!-- NProgress -->
  <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

  <link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <!-- Switchery -->
  <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
  <!-- starrr -->
  <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />


  <!-- Ion.RangeSlider -->
  <!--
  <link href="{{ asset('vendors/normalize-css/normalize.css') }}" rel="stylesheet">-->
  <link href="{{ asset('vendors/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
  <!-- Bootstrap Colorpicker -->
  <!--<link href="{{asset('vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">-->

  <link href="{{asset('vendors/cropper/dist/cropper.min.css')}}" rel="stylesheet">

  <!-- Fin de plugins Calendario -->

  <!-- Datatables -->
  <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

  <!-- jQuery custom content scroller -->
  <link href="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style 
  <link href="{{ asset('vendors/build/css/custom.min.css') }}" rel="stylesheet">-->
  <link rel="stylesheet" href="{{asset ('../resources/css/global.css')}}">
</head>

<body class="nav-md footer_fixed">



      <!-- page content -->
        @yield('content')

      <!-- /page content -->

      <!-- footer content
        <footer>
          <div class="pull-right">
            Laravel 9.x - Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
         /footer content -->

    <script language="JavaScript" type="text/javascript" src="{{asset ('../resources/js/global.js')}}"></script>
  <!-- jQuery -->
  <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
  
  <!-- FastClick -->
  <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <!--<script src="../vendors/nprogress/nprogress.js"></script>-->
  <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
  <!-- Chart.js -->
  <script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
  <!-- gauge.js -->
  <!--<script src="../vendors/gauge.js/dist/gauge.min.js"></script>-->
  <!-- bootstrap-progressbar -->
  <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
  <!-- Skycons -->
  <!--<script src="../vendors/skycons/skycons.js"></script>-->
  <!-- Flot -->
  <!--<script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>-->
  <!-- Flot plugins -->
  <!--<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>-->
  <!-- DateJS -->
  <!--<script src="../vendors/DateJS/build/date.js"></script>-->
  <!-- JQVMap -->
  <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
  <!--<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>-->

  <!-- Inicio de plugins Calendario -->
  <!-- bootstrap-daterangepicker -->
  <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- bootstrap-datetimepicker -->
  <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <!-- Ion.RangeSlider -->
  <script src="{{asset('vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
  <!-- Bootstrap Colorpicker -->
  <!--<script src="{{asset('vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>-->
  <!-- Fin de plugins Calendario -->


  <!-- bootstrap-wysiwyg -->
  <script src="{{ asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
  <script src="{{ asset('vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
  <script src="{{ asset('vendors/google-code-prettify/src/prettify.js') }}"></script>
  <!-- jQuery Tags Input -->
  <script src="{{ asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
  <!-- Switchery -->
  <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
  <!-- Parsley -->
  <script src="{{ asset('vendors/parsleyjs/dist/parsley.min.js') }}"></script>
  <!-- Autosize -->
  <script src="{{ asset('vendors/autosize/dist/autosize.min.js') }}"></script>
  <!-- jQuery autocomplete -->
  <script src="{{ asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
  <!-- starrr -->
  <script src="{{ asset('vendors/starrr/dist/starrr.js') }}"></script>
  <!-- Custom Theme Scripts -->
  <!-- Datatables -->
  <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
  <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
  <!--<script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>-->

  <!-- referencias de las graficas-->
  <!-- <script src="{{ asset('vendors/graficas-api/charts.js?v=1.0') }}"></script>-->
  <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
  <script src="{{ asset('vendors/cropper/dist/cropper.min.js') }}"></script>
  <script src="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <!--
  <script src="{{ asset('js/custom.min.js') }}"></script>-->


  </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('jscustom')
</body>

</html>

