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
            <h3>Perfiles</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crear perfiles/roles <small></small></h2>
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
                    <form id="demo-form2" name="frmregistra" action="{{route('perfil.store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Perfil/Rol<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="descripcion2" value="{{ old('descripcion') }}" name="descripcion" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comentario <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="comentario2" value="{{ old('comentario') }}" name="comentario" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('perfil.index') }}" type="button">Cancelar</a>
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
    function ModalCrear() {
        let cont = 0;
        //Valida que los campos obligatorios no estén vacios
        if ($('#descripcion2').val().length != 0) {

            //Valida que ningun campo contenga errores señalados
            if ($("#descripcion2").hasClass("parsley-error") == false && $("#comentario2").hasClass("parsley-error") == false) {
                cont = 1;
                setTimeout(() => {
                    Swal.fire({
                        title: '¿Seguro que quieres crear el perfil?',
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



        if (cont == 0) {
            $('#enviar').trigger('click');
        }
    }
</script>
@endpush
