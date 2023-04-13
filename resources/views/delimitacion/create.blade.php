@extends('layouts.appfront')

@section('content')

@if(Session::get('perfil') == 'Administrador')

@php
echo "en home";
@endphp

@endif
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Delimitaciones</h3>
    </div>

    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Crear delimitaciones <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        @if (Session::has('error'))

        <p class="alert alert-danger alert-dismissible show" role="alert">{{ Session::get('error') }}</p>

        @endif
        <div class="x_content">
          <br />
          <form id="demo-form2" name="frmregistra" method="POST" action="{{route('delimitacion.store')}}" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pais <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="id_pais" id="id_pais2" required>
                  <option value="">Seleccione un pais</option>
                  @foreach($dataPais as $pais)
                  <option value="{{$pais->id_pais}}">{{$pais->nombre_pais}}</option>

                  @endforeach
                </select>
              </div>
            </div>
            <div id="estadito" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Estado <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="id_estado" id="id_estado2" required>
                  <option value="">Seleccione un estado</option>
                </select>
              </div>
            </div>
            <div id="ciudadcita" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Ciudad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="id_ciudad" id="id_ciudad2" required>
                  <option value="">Seleccione una ciudad</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Latitud <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="latitud2" name="latitud_delimitacion" id="latitud_delimitacion" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Longitud<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="longitud2" name="longitud_delimitacion" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a class="btn btn-danger" href="{{ route('delimitacion.index') }}" type="button">Cancelar</a>
                <button class="btn btn-primary" type="reset">Limpiar</button>
                <button onclick="ModalCrear()" type="button" class="btn btn-success">Enviar</button>
                <button hidden id="enviar" type="submit"></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Confirmar para la creación, si no estas seguro puedes cancelar
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Save changes</button>
                </div>
              </div>
            </div>
          </div>-->


  @endsection
  @push('jscustom')
  <script>
    $(window).on("load", function() {
      $('#id_pais2').on('change', consultaEstados);
      $('#id_estado2').on('change', consultaCiudades);
      $('#estadito').hide();
      $('#ciudadcita').hide();
    });

    function consultaEstados() {
      $('#estadito').show();
      var ppp = $('#id_pais2').val();

      if (!ppp) {
        //$('#id_estado2').html('<option value="">Seleccione un estado</option>');
        $('#estadito').hide();
        return;
      }
      $('#ciudadcita').hide();

      //AJAX
      $.get('../apiPrivada/mostrarEstados/' + ppp + '/niveles', function(dataPais) {
        //var html_select;
        var html_select = '<option value="">Seleccione un estado</option>';
        for (var i = 0; i < dataPais.length; i++)

          html_select += '<option value="' + dataPais[i].id_estado + '" @if( old ("' + id_estado + '")==' + $dataPais[i].id_estado + ') selected @endif >' + dataPais[i].nombre_estado + '</option>';
        $('#id_estado2').html(html_select);
      });

    }

    function consultaCiudades() {
      $('#ciudadcita').show();
      var ccc = $('#id_estado2').val();

      if (!ccc) {
        //$('#id_estado2').html('<option value="">Seleccione un estado</option>');
        $('#ciudadcita').hide();
        return;
      }

      //AJAX
      $.get('../apiPrivada/mostrarCiudades/' + ccc + '/niveles', function(dataEstado) {
        //var html_select;
        var html_select = '<option value="">Seleccione una ciudad</option>';
        for (var i = 0; i < dataEstado.length; i++)

          html_select += '<option value="' + dataEstado[i].id_ciudad + '" @if( old ("' + id_ciudad + '")==' + $dataEstado[i].id_ciudad + ') selected @endif >' + dataEstado[i].nombre_ciudad + '</option>';
        $('#id_ciudad2').html(html_select);
      });

    }








    function ModalCrear() {
      let cont = 0;
      let latitud = $('#latitud2').val();
      let longitud = $('#longitud2').val();

      function isValidCoordinates(coordinates) {
        if (!coordinates.match(/^[-]?\d+[\.]?\d*, [-]?\d+[\.]?\d*$/)) {
          return false;
        }
        return true;
      }
      //Valida que las coordenadas sean correctas
      if (isValidCoordinates(latitud + ", " + longitud) == true) {
        //Valida punto en latitud y longitud


        //Valida que los campos obligatorios no estén vacios
        if ($('#id_ciudad2').val().length != 0 && $('#latitud2').val().length != 0 && $('#longitud2').val().length != 0) {

          //Valida que ningun campo contenga errores señalados
          if ($("#id_ciudad2").hasClass("parsley-error") == false && $("#latitud2").hasClass("parsley-error") == false && $("#longitud2").hasClass("parsley-error") == false) {
            cont = 1;
            setTimeout(() => {
              Swal.fire({
                title: '¿Seguro que quieres crear la delimitación?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Crear!',
                cancelButtonText: 'Cancelar'
              }).then((result) => {
                if (result.isConfirmed) {
                  document.forms["frmregistra"].submit();
                }
              })
            }, 300);
          }
        }
      }
      if (cont == 0) {
        $('#enviar').trigger('click');
      }
    }
  </script>
  @endpush