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
      <h3>Editar valoraciones de monumentos</h3>
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
          <h2>Datos a modificar</h2>
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
        <div class="x_content">
          <br />
          <form id="frmedita2" data-parsley-validate class="form-horizontal form-label-left" name="frmedita" method="post" action="{{route('valoracion.update',['id'=>$data->tipo_comentario])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="descripcion2" class="control-label col-md-3 col-sm-3 col-xs-12">Valoración</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="text" value="{{$data->descripcion}}" name="descripcion" id="descripcion2">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('valoracion.index')}}"><input class="btn btn-primary" type="button" value="Cancel" style="border: none;"></input></a>
                <input type="button" name="save" id="save2" class="btn btn-success" onclick="ModalEditar()" value="Submit" style="border: none;"></input>
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
    function ModalEditar() {
      Swal.fire({
        title: 'En serio quiere hacer este cambio?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Guardado!',
            icon: 'success',
            confirmButtonText: "Ok"
          }).then(() => {
            document.forms["frmedita"].submit();
          })
        }
      })
    }
  </script>
  @endpush
