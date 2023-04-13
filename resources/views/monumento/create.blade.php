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
      <h3>Monumentos</h3>
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
          <h2>Crear monumentos <small></small></h2>
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
          <form id="" data-parsley-validate class="form-horizontal form-label-left" name="frmregistra" method="post" action="{{route('monumento.store')}}">
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="nombre_monumento" value="{{ old('nombre_monumento') }}" id="nombre2" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="descripcion_monumento" value="{{ old('descripcion_monumento') }}" id="descripcion2" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Año*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="anio_monumento" id="anio2" value="{{ old('anio_monumento') }}" class="date-picker form-control col-md-7 col-xs-12" required="required" type="number" max="2030" min="1900" placeholder="Introducir números de cuatro digitos">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="tipo_monumento" id="tipo_monumento2" class="form-control col-md-7 col-xs-12">
                  @foreach($dataTipo as $tipo)
                  <option value="{{$tipo->tipo_monumento}}" @if( old ("tipo_monumento")==$tipo->tipo_monumento) selected @endif>{{$tipo->descripcion}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitud*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="latitud_monumento" value="{{ old('latitud_monumento') }}" id="latitud2" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitud*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="longitud_monumento" id="longitud2" value="{{ old('longitud_monumento') }}" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a class="btn btn-danger" href="{{ route('monumento.index') }}" type="button">Cancelar</a>
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
</div>

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
      //Valida que los campos obligatorios no estén vacios
      if ($('#nombre2').val().length != 0 && $('#descripcion2').val().length != 0 && $('#anio2').val().length != 0 && $('#latitud2').val().length != 0 && $('#longitud2').val().length != 0) {
        //Valida que ningun campo contenga errores señalados
        if ($("#nombre2").hasClass("parsley-error") == false && $("#descripcion2").hasClass("parsley-error") == false && $("#anio2").hasClass("parsley-error") == false && $("#latitud2").hasClass("parsley-error") == false && $("#longitud2").hasClass("parsley-error") == false) {
          cont = 1;
          setTimeout(() => {
            Swal.fire({
              title: '¿Seguro que quieres crear el monumento?',
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