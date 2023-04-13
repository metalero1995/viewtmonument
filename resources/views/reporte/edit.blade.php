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
            <h3>Reportes</h3>
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
                    <h2>Editar reportes <small></small></h2>
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
                    <form id="demo-form2" name="frmregistra" action="{{route('contacto.update',['id'=>$contacto->_id])}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo electrónico <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                            <input value="{{$contacto->correo}}" type="text" id="correo" name="correo" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Asunto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{$contacto->asunto}}" type="text" id="asunto" name="asunto" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{$contacto->descripcion}}" type="text" id="descripcion" name="descripcion" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Estatus <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select type="text" id="estatus" name="estatus" required="required" class="form-control col-md-7 col-xs-12" required>
                                    @if($contacto->estatus == "En proceso")
                                        <option value="No revisado">No revisado</option>
                                        <option value="En proceso" selected>En proceso</option>
                                        <option value="Revisado">Revisado</option>
                                    @endif
                                    @if($contacto->estatus == "No revisado")
                                        <option value="No revisado"  selected>No revisado</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Revisado">Revisado</option>
                                    @endif
                                    @if($contacto->estatus == "Revisado")
                                        <option value="No revisado">No revisado</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Revisado"  selected>Revisado</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('reporte.index') }}" type="button">Cancelar</a>
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
</div>
@endsection

@push('jscustom')
<script>
    function ModalEditar() {
        let cont = 0;
        //Valida que los campos obligatorios no estén vacios
        if ($('#correo').val().length != 0 && $('#asunto').val().length != 0 && $('#estatus').val().length != 0 && $('#descripcion').val().length != 0) {

            //Valida que ningun campo contenga errores señalados
            if ($("#descripcion").hasClass("parsley-error") == false && $("#correo").hasClass("parsley-error") == false && $("#asunto").hasClass("parsley-error") == false && $("#estatus").hasClass("parsley-error") == false) {
                cont = 1;
                setTimeout(() => {
                    Swal.fire({
                        title: '¿Seguro que quieres editar el reporte?',
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