@extends('layouts.busquedaDataTable')

@section('content')
@include('include.header')


<!-- page content -->
<main>
  <div class="">
    <div class="page-title">


      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="">
          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th></th>

                </tr>
              </thead>
              <tbody class="ordenarNombreeImagen">
                @foreach($dataImagenes as $monumento)
                @if($monumento->tipo_imagen==1)
                <tr class="formatoNombreeImagen">
                  <td class="nombres_Monumentos">{{ $monumento->monumento->nombre_monumento }}</td>
                  <td><img id="{{$monumento->id_monumento}}" class="open-modal imagen" data-open="modal" data-toggle="modal" src="{{ $monumento->url_imagen }}"></td>

                </tr>
                @endif
                @endforeach
              </tbody>
            </table>

          </div>

          <div class="modal" id="modal" data-animation="slideInOutLeft">
            <div id="parte1">

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
<?php
include("../resources/views/include/footer.php");
?>
@endsection
@push('jscustom')



<script type="text/javascript">
  //*-------------------INICIO DE TODO DE LOS MONUMENTOS------------------------------------*//
  let comentariosMax = 0;
  let idMonumentoGuardado = 0;

  $("img").click(function() {

    let userID = $("#nombreUsuario").val();
    let idMonumento = $(this).attr("id");

    if (userID == "" || userID == null) {
      userID = 3;
    }

    $.get('apiPublica/buscarInteraccion/' + idMonumento + '/' + userID + '/niveles', function(dataInteraccion) {
      if (dataInteraccion[0] == null) {
        $.ajax({

          data: JSON.stringify({
            idMonumento,
            userID,
            "_token": $("meta[name='csrf-token']").attr("content")
          }),
          contentType: 'application/json',
          dataType: "json",
          url: 'apiPublica/crearInteraccion',
          type: 'post',
        });

      } else {
        let contadorConsulta = dataInteraccion[0].consultado;
        contadorConsulta = parseInt(contadorConsulta) + 1;
        contadorConsulta = String(contadorConsulta);
        $.ajax({
          data: JSON.stringify({
            contadorConsulta,
            "_token": $("meta[name='csrf-token']").attr("content")
          }),
          contentType: 'application/json',
          dataType: "json",
          url: 'apiPublica/actualizarInteraccion/' + dataInteraccion[0].id_interacciones + '',
          type: 'put',
          success: function(response) {},
          error: function(error) {}
        });

      }

    });



    $.get('apiPublica/mostrarModalMonumentos/' + idMonumento + '/niveles', function(dataModalMonumentos) {
      //var html_select;
      var html_select = `
        <div class="modal-dialog">  
          <header class="modal-header">` + dataModalMonumentos[0].nombre_monumento + `
          <button class="close-modal" aria-label="close modal" data-close>✕</button>
          </header> 
          <hr class="linea_horizontal">
          <section class="modal-content">
            <img class="open-modal imagen_modal" data-open="modal" data-toggle="modal" src="` + dataModalMonumentos[0].url_imagen + `" alt="">
						<p class="p_modal">` + dataModalMonumentos[0].descripcion_monumento + `. Fue construido en el año <b>` + dataModalMonumentos[0].anio_monumento + ` </b> </p>
						<p class="p_modal">Se encuentra en<b> ` + dataModalMonumentos[0].nombre_ciudad + ` ` + dataModalMonumentos[0].nombre_estado + `, ` + dataModalMonumentos[0].nombre_pais + `</b></p>
						<div id="map" ></div>
          </section>
        
       
        <section class="modal-content">
          <div class="ordenarRaiting">
            <h3 class="tit_comentario">Comentarios</h3>
            @if(Auth::user()!=null)
              <div id="raiting" class="rate">
    
              </div>
            @endif 
          </div>
          @if(Auth::user()!=null)
              <input hidden id="nombreUsuario" value="{{Auth::user()->id}}"></input>
              <input name="descripcion_comentario" placeholder="Escribe un comentario." class="input_comentario" id="input_comentario" type="text">
          @elseif(Auth::user()==null)
            <p readonly value="" class="input_comentario" id="input_comentario" type="text">Para comentar debes <b><a class="borrarEstilodeA" href="login">iniciar sesión</a></b></p>
          @endif  

          <div id="comentarios">
            <p class="espacio">&nbsp&nbsp&nbsp&nbsp</p>
            <div id="parte2" >

            </div>
          </div>
          <div>
          <button onclick="masComentarios(null,5)" id="verMas">Ver más comentarios...</button>
          </div>
        </section>
        </div> 
        `;

      $('#parte1').html(html_select);
      mapita(dataModalMonumentos[0].latitud_monumento, dataModalMonumentos[0].longitud_monumento);
      masComentarios(idMonumento, 5);

      modal();
      $.get('apiPublica/mostrarRaiting/', function(dataRaiting) {
        var idPersona = $("#nombreUsuario").val();
        $.get('apiPublica/buscarInteraccion/' + idMonumento + '/' + idPersona + '/niveles', function(dataRaitingPersona) {
          var html_select = "";
          if (dataRaitingPersona[0] != null) {
            for (var i = 0; i < dataRaiting.length; i++) {
              if (dataRaitingPersona[0].tipo_comentario == dataRaiting[i].tipo_comentario) {
                html_select += `
                  <input type="radio" checked id="star` + dataRaiting[i].tipo_comentario + `" name="rate" value="` + dataRaiting[i].tipo_comentario + `" />
                  <label checked for="star` + dataRaiting[i].tipo_comentario + `" title="` + dataRaiting[i].descripcion + `"> stars ` + dataRaiting[i].tipo_comentario + `</label>
                `;
              } else {
                html_select += `
                  <input type="radio" id="star` + dataRaiting[i].tipo_comentario + `" name="rate" value="` + dataRaiting[i].tipo_comentario + `" />
                  <label for="star` + dataRaiting[i].tipo_comentario + `" title="` + dataRaiting[i].descripcion + `"> stars ` + dataRaiting[i].tipo_comentario + `</label>
                `;
              }
            }
            $('#raiting').html(html_select);
          } else {

            for (var i = 0; i < dataRaiting.length; i++) {
              html_select += `
                  <input type="radio" id="star` + dataRaiting[i].tipo_comentario + `" name="rate" value="` + dataRaiting[i].tipo_comentario + `" />
                  <label for="star` + dataRaiting[i].tipo_comentario + `" title="` + dataRaiting[i].descripcion + `"> stars ` + dataRaiting[i].tipo_comentario + `</label>
                `;
            }
            $('#raiting').html(html_select);

          }

          $("input[name='rate']").change(function() {
            let tipo_comentario = $(this).val();
            $.ajax({

              data: JSON.stringify({
                idMonumento,
                idPersona,
                tipo_comentario,
                "_token": $("meta[name='csrf-token']").attr("content")
              }),
              contentType: 'application/json',
              dataType: "json",
              url: 'apiPublica/actualizarInteraccion/' + dataRaitingPersona[0].id_interacciones + '',
              type: 'put',
            });

          });
        });
      });

    });
  });

  function masComentarios(idMonumento, comentariosMaximos) {
    if (idMonumento != null) {
      idMonumentoGuardado = idMonumento;
    }
    comentariosMax = comentariosMax + comentariosMaximos;
    $.get('apiPublica/mostrarComentariosMonumentosV2/' + idMonumentoGuardado + '/' + comentariosMax + '/niveles', function(dataComentariosMonumentosV2) {
      let html_select = "";
      if (dataComentariosMonumentosV2[0] == null) {
        html_select += `
            <div class="recuadro">
              <b><p class="p_modal_comentarios">Aún no hay comentarios</p></b>
            </div>
          `;
        $("#verMas").hide();
        $('#parte2').html(html_select);
      } else {

        for (var i = 0; i < dataComentariosMonumentosV2.length; i++) {
          html_select += `
            <div class="recuadro">
              <b><p class="p_modal_comentarios">` + dataComentariosMonumentosV2[i].name + `, dice</p></b>
              <p class="p_modal_comentarios">` + dataComentariosMonumentosV2[i].descripcion_comentario + `</p>
            </div>
          `;
        }
        $('#parte2').html(html_select);

        $.get('apiPublica/totalComentariosMonumentos/' + idMonumentoGuardado + '/niveles', function(totalComentariosMonumentos) {
          if (comentariosMax >= totalComentariosMonumentos[0].total) {
            $("#verMas").hide();
          }
        });
      }



      $("#input_comentario").on('keyup', function(e) {
        var keycode = e.keyCode || e.which;
        if (keycode == 13) {
          if ($("#input_comentario").val() != "") {
            var comentarioPersona = $("#input_comentario").val();
            var idPersona = $("#nombreUsuario").val();

            $.ajax({
              data: {
                comentarioPersona,
                idMonumentoGuardado,
                idPersona,
                "_token": $("meta[name='csrf-token']").attr("content")
              },
              url: 'apiPublica/guardarComentario',
              type: 'post',
              success: function(data) {
                masComentarios(null, 0);
              }
            });
            $("#input_comentario").val('');
          }
        }

      });
    });

  };

  //TODO PARA QUE FUNCIONE EL MODAL
  function modal() {
    var openEls = document.querySelectorAll("[data-open]");
    var closeEls = document.querySelectorAll("[data-close]");
    var isVisible = "is-visible";

    for (var el of openEls) {
      el.addEventListener("click", function() {
        const modalId = this.dataset.open;
        document.getElementById(modalId).classList.add(isVisible);
        $('.modal-dialog').scrollTop(0);
        const firstNameInput = document.getElementById('input_comentario');

      });
    }

    for (var el of closeEls) {
      el.addEventListener("click", function() {
        this.parentElement.parentElement.parentElement.classList.remove(isVisible);
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
        //$("#verMas").show();
        comentariosMax = 0;
      });
    }

    document.addEventListener("click", e => {
      if (e.target == document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
        //$("#verMas").show();
        comentariosMax = 0;
      }
    });

    document.addEventListener("keyup", e => {
      // if we press the ESC
      if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
        //$("#verMas").show();
        comentariosMax = 0;

      }
    });
  }

  function mapita(latitud, longitud) {
    var map = new maplibregl.Map({
      container: 'map',
      style: 'https://api.maptiler.com/maps/streets/style.json?key=get_your_own_OpIi9ZULNHzrESv6T2vL',
      center: [longitud, latitud],
      zoom: 15
    });

    var marker = new maplibregl.Marker()
      .setLngLat([longitud, latitud])
      .addTo(map);
  }

  //*-------------------FIN DE TODO DE LOS MONUMENTOS------------------------------------*//


  $(function() {
    modal();
    //PLACEHOLDER DEL FORM
    $('.form-control').attr('placeholder', 'Escribe el nombre del monumento...');

    //AGREGAMOS UN VALOR AL SELECT PARA QUE MUESTRE 12 REGISTROS
    select = document.getElementsByTagName("select")[0];
    var opt = document.createElement('option');
    opt.value = 12;
    opt.innerHTML = 12;
    select.appendChild(opt);
    //Seleccion de que valor estará seleccionado
    document.getElementsByTagName("option")[4].setAttribute('selected', 'selected');
    $(select).change();

  });


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
      title: '¿Quieres eliminar este monumento?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        document.getElementById('form-del{{$monumento->id_monumento}}').submit();

      }
    })
  }
</script>
@endpush