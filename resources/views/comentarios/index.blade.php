@extends('layouts.appfront')

@section('content')

@if(Session::get('perfil') == 'Administrador')

@php
echo "en home";
@endphp

@endif

<!-- page content -->
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
          <h2>Listado de comentarios</h2>
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
          @if (Session::has('success'))

          <p class="alert alert-success alert-dismissible show" role="alert">{{ Session::get('success') }}</p>

          @endif
        </div>
        <div class="x_content">

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Monumento</th>
                <th>Valoración</th>
                <th>Comentario</th>
                <th>Fecha creación</th>
                <th>Fecha de modificacion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @php
              $cont = 1;
              @endphp
              @foreach($data as $comentarios)
              <tr>
                <td>{{ $cont }}</td>
                @php
                $cont++;
                @endphp
                <td>{{ $comentarios->usuario->name ?? 'NULO'}}</td>
                <td>{{ $comentarios->monumentos->nombre_monumento ?? 'NULO'}}</td>
                <td>{{ $comentarios->descripcion_comentario}}</td>
                <td>{{ $comentarios->created_at}}</td>
                <td>{{ $comentarios->updated_at}}</td>
                <td><a href="{{ route('comentarios.edit',['id'=>$comentarios->id_comentario]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  &nbsp;
                  <form method="post" id="forms-del{{$comentarios->id_comentario}}" name="form-del{{$comentarios->id_comentario}}" action="{{ route('comentarios.destroy',['id'=>$comentarios->id_comentario]) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <a href="#" onclick="ModalEliminar()"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                  </form>
                </td>
              </tr>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection

@push('jscustom')
<script type="text/javascript">
  $('#datatable-responsive').DataTable({
    language: {
      processing: "Procesando...",
      search: "Buscar",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No se encontraron resultados",
      emptyTable: "Ninguna información registrada",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Último"
      },
      aria: {
        sortAscending: ": Activar para ordenar la columna de manera ascendente",
        sortDescending: ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
  //FIN - DataTables

  $('#fechaInicio2').datetimepicker({
    format: 'DD/MM/YYYY'
  });

  $('#fechaFin2').datetimepicker({
    format: 'DD/MM/YYYY'
  });

  function ModalEliminar() {
    Swal.fire({
      title: '¿Quieres eliminar este comentario?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        document.getElementById('forms-del{{$comentarios->id_comentario}}').submit();

      }
    })
  }
</script>
@endpush
