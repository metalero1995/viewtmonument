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
          <h2>Editar delimitaciones<small> </small></h2>
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
          @if (Session::has('error'))

          <p class="alert alert-danger alert-dismissible show" role="alert">{{ Session::get('error') }}</p>

          @endif
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" name="frmregistra" method="POST" action="{{route('delimitacion.update',['id'=>$data->id_delimitacion])}}" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pais <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  @foreach($dataPais as $pais)
                  @if($data->ciudad->id_pais == $pais->id_pais)
                  <label class="control-label" value="{{$pais->id_pais}}" selected>{{$pais->nombre_pais}}</label>
                  @endif
                  @endforeach
              </div>
            </div>
            <div id="estadito" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Estado <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  @foreach($dataEstado as $estado)

                  @if($data->ciudad->id_estado == $estado->id_estado)
                  <label class="control-label" id="valorEstado" value="{{$estado->id_estado}}" selected>{{$estado->nombre_estado}}</label>
                  @endif
                  @endforeach
                </>
              </div>
            </div>
            <div id="ciudadcita" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Ciudad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  @foreach($dataCiudad as $ciudad)

                  @if($data->id_ciudad == $ciudad->id_ciudad)
                  <label class="control-labell"  id="valorCiudad" value="{{$ciudad->id_ciudad}}" selected>{{$ciudad->nombre_ciudad}}</label>
                  @endif
                  @endforeach
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Latitud <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="latitud_delimitacion" id="latitud2" value="{{$data->latitud_delimitacion}}" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Longitud<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="longitud2" name="longitud_delimitacion" value="{{$data->longitud_delimitacion}}" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a class="btn btn-danger" href="{{ route('delimitacion.index') }}" type="button">Cancelar</a>
                <button class="btn btn-primary" type="reset">Limpiar</button>
                <button onclick="ModalEditar()" type="button" class="btn btn-success">Enviar</button>
                <button hidden id="enviar" type="submit"></button>
              </div>
            </div>
        </div>
        <!-- Modal -->

        </form>
      </div>
    </div>
  </div>
</div>



@endsection

@push('jscustom')
<script>
 








  function ModalEditar() {
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
      if ($('#latitud2').val().length != 0 && $('#longitud2').val().length != 0) {

        //Valida que ningun campo contenga errores señalados
        if ($("#latitud2").hasClass("parsley-error") == false && $("#longitud2").hasClass("parsley-error") == false) {
          cont = 1;
          setTimeout(() => {
            Swal.fire({
              title: '¿Seguro que quieres editar la delimitación?',
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