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
            <h3>Comentarios</h3>
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
                    <h2>Editar comentarios <small></small></h2>
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
                    <form id="" name="frmregistra" method="POST" action="{{route('comentarios.update',['id'=>$data->id_comentario])}}" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">


                                @foreach($dataUser as $usuarios)
                                @if($data->id_usuario == $usuarios->id)
                                <label class="control-label " value="{{$usuarios->id}}">{{$usuarios->name}}</label>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Monumento <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                @foreach($dataMonumentos as $monumentos)
                                @if($data->id_monumento == $monumentos->id_monumento)
                                <label class="control-label " value="{{$monumentos->id_monumento}}">{{$monumentos->nombre_monumento}}</label>

                                @endif
                                @endforeach
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valoración<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                @foreach($dataValoracion as $valoracion)
                                @if($data->tipo_comentario == $valoracion->tipo_comentario)
                                <label  class="control-label "  value="{{$valoracion->tipo_comentario}}">{{$valoracion->descripcion}}</label>
                                @endif
                                @endforeach
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comentario<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" id="descripcion_comentario2" style="resize:none; height:80px;" name="descripcion_comentario" value="{{$data->descripcion_comentario}}" required="required" class="form-control col-md-7 col-xs-12">{{$data->descripcion_comentario}}</textarea>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('comentarios.index') }}" type="button">Cancelar</a>
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
        Swal.fire({
            title: '¿Seguro que quieres editar el comentario?',
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
                    document.forms["frmregistra"].submit();
                })
            }
        })
    }
</script>
@endpush