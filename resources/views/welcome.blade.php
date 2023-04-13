<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ViewTMonument</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
    <link rel="stylesheet" href="{{asset ('css/inicio.css')}}">
    <link rel="stylesheet" href="{{asset ('css/global.css')}}">

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>
    <link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet" />


    <style>
        body {
            font-family: 'MarkBold', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    @include('include.header')


    <!--Elementos principales del body-->
    <main>
        <!--Todas las pantallas del drag and drop-->
        <div>
            <!--Fondo drag and drop-->
            <div class="contenedor_imagen">
                <!--
            <img class="transparente" src="img/1920x1080.jpg" alt="Imagen_Monumento">
            Funcionalidades del drag and drop-->
                <div class="escenario_principal">
                    <!--Texto principal drag and drop-->
                    <h2 class="texto_principal">Descubre la <br>grandeza de los <br>monumentos</h2>
                    <!--Recuadro drag and drop-->
                    <div class="cuadrado">
                        <h2 class="sustituir">Arrastra y suelta aquí o</h2>
                        <button class="texto_bf">buscar archivos</button>
                        <input id="imageUpload" hidden value="busca archivos" type="file">
                    </div>
                    <img id="imagePreview" style="height: 1px; width: 1px;">
                </div>
            </div>
            <!--Boton que permite el scrolleo
            <span>
                 <a class="boton_abajo"> ↓ </a>
            </span>
            -->
        </div>
        <!--<img id="imagePreview" style="height: 0px; width: 0px;" />-->



        <div hidden id="label-container"></div>
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
        <script type="text/javascript">

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript">

        </script>

        <!--Todas las pantallas de la información de la página-->
        <div>
            <hr class="separacion">
            <div class="acomodo_general_1">
                <div class="acomodo_primero">
                    <h3 class="titulos">Identifica monumentos</h3> <br>
                    <p class="parrafos">
                        Explora los monumentos de tu ciudad, descubre su historia, el año de su construcción, su ubicación y visita los mismos. Además de disfrutar de una experiencia cultural, aprenderás más sobre tu ciudad y su patrimonio.
                </div>
                <img class="info_imagenes" src="{{asset ('img/azteca_1_1000x1000.png')}}">
            </div>
            <span class="acomodo_general_2">
                <div class="acomodo_segundo">
                    <h3 class="titulos">Escanea monumentos</h3> <br>
                    <p class="parrafos">
                        Disfruta de una experiencia inmersiva al escanear los monumentos de tu ciudad con la cámara de tu dispositivo móvil. Utilizando la tecnología de reconocimiento de imagen, la aplicación te brindará información detallada sobre cada monumento, incluyendo su historia, el año de su construcción y su ubicación exacta. </p>
                </div>
                <img class="info_imagenes" src="{{asset ('img/azteca_2_1000x1000.png')}}">
            </span>
        </div>
        <!--Modales las pantallas de la información de la página-->

        <div class="modal" id="modal" data-animation="slideInOutLeft">
            <div id="parte1">

            </div>
        </div>
    </main>

    <?php
    include("../resources/views/include/footer.php");
    ?>
</body>
<script language="JavaScript" type="text/javascript" src="{{asset ('js/inicio.js')}}"></script>
<script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>
<script>
    let comentariosMax = 0;
    let idMonumentoGuardado = 0;

    function cargaInfoModal(idMMM) {

        let userID = $("#nombreUsuario").val();
        let idMonumento = idMMM;

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
    }

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
    function abrirModal(){
        var isVisible = "is-visible";
        const modalId = 'modal';
        document.getElementById(modalId).classList.add(isVisible);
        $('.modal-dialog').scrollTop(0);
        const firstNameInput = document.getElementById('input_comentario');
    }

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
    });
</script>

</html>