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
      <h3>Usuarios</h3>
    </div>

    <!--
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ir!</button>
                    </span>
                  </div>
                </div>
              </div>
              -->
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Editar usuarios <small></small></h2>
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
          <form id="demo-form2" enctype="multipart/form-data" name="frmregistra" action="{{route('user.update',['id'=>$data->id])}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Perfil/Rol <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="PerfilID2" name="PerfilID" required="required" class="form-control col-md-7 col-xs-12">

                  @foreach($data2 as $perfil)

                  @if($data->PerfilID == $perfil->PerfilID)
                  <option value="{{$perfil->PerfilID}}" selected>{{$perfil->descripcion}}</option>
                  @else
                  <option value="{{$perfil->PerfilID}}">{{$perfil->descripcion}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nombre <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input value="{{$data->name}}" type="text" id="name2" name="name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electrónico <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input value="{{$data->email}}" type="email" id="email2" name="email" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            
            <!--<div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Género <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control col-md-7 col-xs-12" name="gender" id="gender2" required>
                @if($data->gender == 'Hombre')
                    <option value="Hombre" selected>Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                @elseif($data->gender == 'Mujer')
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer" selected>Mujer</option>
                    <option value="Otro">Otro</option>
                @elseif($data->gender == 'Otro')
                <option value="Hombre">Hombre</option>
                    <option value="Mujer" >Mujer</option>
                    <option value="Otro" selected>Otro</option>
                @endif
                </select>
              </div>
            </div>-->
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Edad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input value="{{$data->age}}" type="number" id="age2" name="age" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dirección <span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea style="resize:none; height:80px;" type="text" id="address2" name="address" class="form-control col-md-7 col-xs-12">{{$data->address}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de teléfono <span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input value="{{$data->mobile }}" minlength="10" maxlength="10" type="number" id="mobile2" name="mobile" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fotografía <span class="required"></span>
              </label>
              <div class=" col-md-6 col-sm-6 col-xs-12">
                <input type="file" accept="image/.png,.jpg,.gif,.bmp,.webp,.png" id="photo2" name="photo" class="col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a class="btn btn-danger" href="{{ route('user.index') }}" type="button">Cancelar</a>
                <button class="btn btn-primary" type="reset">Limpiar</button>
                <button onclick="ModalEditar()" type="button" class="btn btn-success">Enviar</button>
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
    function ModalEditar() {
      let cont = 0;
      //Valida imagen
      if ($('#photo2').val().split('\\').pop().toLowerCase() == 'jpg' || $('#photo2').val().split('\\').pop().toLowerCase() == 'png' || $('#photo2').val().split('\\').pop().toLowerCase() == 'gif' || $('#photo2').val().split('\\').pop().toLowerCase() == 'bmp' || $('#photo2').val().split('\\').pop().toLowerCase() == 'webp') {
        //Valida un correo correcto
        if ($("#email2").val().indexOf('@', 0) == -1 || $("#email2").val().indexOf('.', 0) == -1) {} else {
          alert('1');
          //Valida un movil correcto
          if (($("#mobile2").val().length == 10 || $("#mobile2").val().length == 0)) {
            alert('2');
            //Valida que los campos obligatorios no estén vacios
            if ($('#name2').val().length != 0 && $('#email2').val().length != 0  && $('#age2').val().length != 0  )  {
              alert('3');
              //Valida que ningun campo contenga errores señalados
              if ($("#name2").hasClass("parsley-error") == false && $("#age2").hasClass("parsley-error") == false && $("#email2").hasClass("parsley-error") == false && $("#address2").hasClass("parsley-error") == false && $("#mobile2").hasClass("parsley-error") == false && $("#photo2").hasClass("parsley-error") == false) {
                cont = 1;
                alert('4');
                setTimeout(() => {
                  Swal.fire({
                    title: '¿Seguro que quieres crear el usuario?',
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
        }
      }
      if (cont == 0) {
        $('#enviar').trigger('click');
      }
    }
  </script>
  @endpush