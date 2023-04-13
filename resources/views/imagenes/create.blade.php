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
      <h3>Imágenes</h3>
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
          <h2>Crear imágenes <small></small></h2>
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
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" name="frmregistra" method="post" action="{{route('imagenes.store')}}">
            @csrf
            <div class="form-group">
              <label for="monumento2" class="control-label col-md-3 col-sm-3 col-xs-12">Monumento*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="id_monumento" id="id_monumento2" class="form-control col-md-7 col-xs-12" require required="required">
                  <option value="">Selecciona un monumento</option>

                  @foreach($dataMonumento as $monumento)
                  <option value="{{$monumento->id_monumento}}">{{$monumento->nombre_monumento}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="descripcion_imagen" id="descripcion2" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Relación de aspecto*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="tipo_imagen" id="tipo_imagen2" class="form-control col-md-7 col-xs-12" require required="required">
                <option value="">Selecciona una relación de aspecto</option>

                  @foreach($dataImagen as $imagen)
                  <option value="{{$imagen->tipo_imagen}}">{{$imagen->tamano}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fotografía*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" accept="image/.png,.jpg,.gif,.bmp,.webp,.png" id="url_imagen2" name="url_imagen" class="col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a class="btn btn-danger" href="{{ route('imagenes.index') }}" type="button">Cancelar</a>
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

  @endsection
  @push('jscustom')
  <script>
    function ModalCrear() {
      let cont = 0;
      //Valida que los campos obligatorios no estén vacios
      if ($('#id_monumento2').val().length != 0 && $('#descripcion2').val().length != 0 && $('#tipo_imagen2').val().length != 0) {

        //Valida que ningun campo contenga errores señalados
        if ($("#id_monumento2").hasClass("parsley-error") == false && $("#descripcion2").hasClass("parsley-error") == false && $("#tipo_imagen2").hasClass("parsley-error") == false) {
          cont =1;
          setTimeout(() => {

            Swal.fire({
              title: '¿Seguro que quieres cargar la imagen?',
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

          }, 500);
        }
      }
      if (cont == 0) {
        $('#enviar').trigger('click');
      }
    }
  </script>
  @endpush