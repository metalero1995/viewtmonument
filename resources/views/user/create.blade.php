@extends('layouts.appfront')

@section('content')

@if(Session::get('perfil') == 'Administrador')

@php
echo "en home";
@endphp

@endif


<div class="page-title">
  <div class="title_left">
    <h3>Usuarios</h3>
  </div>

</div>
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Crear usuarios <small></small></h2>
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
        <form id="demo-form2" name="frmregistra" action="{{route('user.store')}}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Perfil/Rol <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">

              <select type="text" id="PerfilID2" name="PerfilID" required="required" class="form-control col-md-7 col-xs-12" required>
                <option value="">Elige un perfil/rol</option>

                @foreach($data2 as $perfil)
                <option value="{{$perfil->PerfilID}}" @if( old ("PerfilID")==$perfil->PerfilID) selected @endif>{{$perfil->descripcion}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nombre <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name2" name="name" value="{{ old('name') }}" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electrónico <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="email2" name="email" value="{{ old('email') }}" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Género <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control col-md-7 col-xs-12" name="gender" id="gender2" required>
                <option value="">Elige un género</option>
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
          </div>
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
              <select class="form-control col-md-7 col-xs-12" name="ciudad" id="id_ciudad2" required>
                <option value="">Seleccione una ciudad</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Edad <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="age2" name="age" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dirección <span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" id="address2" name="address" style="resize:none; height:80px;" class="form-control col-md-7 col-xs-12">{{ old('address') }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de teléfono <span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" minlength="10" maxlength="10" id="mobile2" value="{{ old('mobile') }}" name="mobile" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contraseña <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="password2" name="password" required="required" class="form-control col-md-7 col-xs-12">
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
    if ($('#photo2').val().split('\\').pop().toLowerCase() == 'jpg' || $('#photo2').val().split('\\').pop().toLowerCase() == 'png' || $('#photo2').val().split('\\').pop().toLowerCase() == 'gif' || $('#photo2').val().split('\\').pop().toLowerCase() == 'bmp' || $('#photo2').val().split('\\').pop().toLowerCase() == 'webp') {

      //Valida un correo correcto

      if ($("#email2").val().indexOf('@', 0) == -1 || $("#email2").val().indexOf('.', 0) == -1) {} else {

        //Valida un movil correcto
        if (($("#mobile2").val().length == 10 || $("#mobile2").val().length == 0)) {

          //Valida que los campos obligatorios no estén vacios
          if ($('#name2').val().length != 0 && $('#email2').val().length != 0 && $('#password2').val().length != 0 && $('#age2').val().length != 0 && $('#gender2').val().length != 0 && $('#PerfilID2').val().length != 0) {

            //Valida que ningun campo contenga errores señalados
            if ($("#age2").hasClass("parsley-error") == false && $("#name2").hasClass("parsley-error") == false && $("#email2").hasClass("parsley-error") == false && $("#address2").hasClass("parsley-error") == false && $("#mobile2").hasClass("parsley-error") == false && $("#password2").hasClass("parsley-error") == false && $("#photo2").hasClass("parsley-error") == false) {
              cont = 1;
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