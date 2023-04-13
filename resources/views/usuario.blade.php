<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
    <link rel="stylesheet" href="{{asset ('css/perfilusuario.css')}}">
    <link rel="stylesheet" href="{{asset ('css/global.css')}}">

    <script src="https://kit.fontawesome.com/a8d4026847.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>



    <title>ViewTMonument</title>
</head>

<body class="acomodo">
    @include('include.header_logged')

    <!--Formulario-->
    <main class="orden_main">

        <div class="card_chica">

            <div class="card_chica_contenido">

                @if($dataUser->photo == null)

                <img src="{{asset('/images/img.jpg')}}" alt="Foto" class="img-circle profile_img">

                @else

                <img src="../{{$dataUser->photo}}" alt="Foto" class="img-circle profile_img">

                @endif

                <h3>{{$dataUser->name}}</h3>

                @if(Auth::check() && $dataUser->id == Auth::user()->id)

                <form id="" data-parsley-validate class="form-horizontal form-label-left" name="frmregistra" enctype="multipart/form-data" method="post" action="{{route('usuario.updatephoto',['id'=>$dataUser->id])}}">
                    @csrf
                    @method('PUT')
                    <!--input type="file" accept="image/.png,.jpg,.gif,.bmp,.webp,.png" name="photo" id="photo2"
                    <button onclick="enviar()" id="enviar" type="submit">Subir una nueva foto</button>-->
                    <div class="container-input">
                        <input accept="image/.png,.jpg,.gif,.bmp,.webp,.png" type="file" name="photo" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" multiple />
                        <label for="file-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                            </svg>
                            <span class="iborrainputfile">Subir foto</span>
                        </label>
                    </div>
                </form>

                @endif
                <p>Miembro desde: <b id='fechaFinal'>{{$dataUser->created_at}}</b></p>
                <input hidden type="text" id="fechaPHP" value="{{$dataUser->created_at}}">
                <input hidden type="text" id="id_user" value="{{$dataUser->id}}">

            </div>

        </div>

        <div class="card_grande">
            <div class="card_grande_header">
                @if (Auth::user()==null || Auth::check() && $dataUser->id != Auth::user()->id)

                <h1>Acerca del usuario</h1>

                @elseif (Auth::check() && $dataUser->id == Auth::user()->id)
                <h1>Configuración del usuario</h1>
                <a title="Salir" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                @endif


            </div>
            <div class="card_grande_contenido">
                <div id="miSeccionActual">
                    <div class="contenido_mayoritario">
                        <div>

                            <p><b>Nombre:</b><br>{{$dataUser->name}}</p>

                            <p><b>Género:</b> <br> {{$dataUser->gender}}</p>

                            <p><b>Correo: </b> <br>{{$dataUser->email}}</p>

                            <p><b>Número:</b><br>{{$dataUser->phone ?? 'Sin número'}}</p>

                        </div>
                        <div>

                            <p><b>Edad:</b><br>{{$dataUser->age}} años</p>

                            <p><b>País:</b><br>{{$dataUser->ciudades->pais->nombre_pais}}</p>

                            <p><b>Estado:</b><br>{{$dataUser->ciudades->estado->nombre_estado}}</p>

                            <p><b>Ciudad:</b><br>{{$dataUser->ciudades->nombre_ciudad}}</p>

                        </div>
                    </div>
                    <p><b>Dirección: </b>{{$dataUser->address ?? 'Sin dirección'}}</p>
                </div>


                <div class="contenido_reciente">

                    <h2>Entradas recientes</h2>
                    @if ($dataInteracciones->count() > 0)
                    @foreach($dataInteracciones as $interaccion)
                    <img src="../{{$interaccion->monumento->imagen->url_imagen}}" alt="">
                    <p>{{$interaccion->monumento->nombre_monumento}}</p>
                    @endforeach
                    @else
                    <p>Aún no hay entradas recientes para este usuario</p>
                    @endif

                </div>

            </div>
            @if (Auth::check() && $dataUser->id == Auth::user()->id)
            <button id="editarPerfil" class="botonEditar">Editar perfil</button>
            @else
            <br id="editarPerfil">
            @endif


        </div>
    </main>

    @include('include.footer_logged')

    <script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>

</body>

</html>
<script>
    let fileInput = document.getElementById("file-1");

    fileInput.addEventListener('change', function(e) {
        e.preventDefault();
        let file = fileInput.files[0];

        if (file && file.type.startsWith("image/")) {
            Swal.fire("Bien hecho!", "Actualizado correctamente", "success").then(
                result => {
                    document.forms["frmregistra"].submit();
                }
            );
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Algo salió mal!"
            });
        }
    });

    //<input type="text" value="{{$dataUser->ciudades->estado->nombre_estado}}">
    //{{$dataUser->ciudades->nombre_ciudad}}

    //Pasar fecha en numeros a texto--------------------------------------------------------------------------------------
    let fechaPHP = document.getElementById("fechaPHP").value;
    var fecha = new Date(fechaPHP);
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById("fechaFinal").innerHTML = fecha.toLocaleDateString("es-ES", options);
    //Aqui terminamos lo de la fecha en numeros a texto.------------------------------------------------------------------

    //Consumimos apis de los paises---------------------------------------------------------------------------------------
    function cargaInicial() {
        $('#id_pais').on('change', consultaEstados);

        $('#id_estado').on('change', consultaCiudades);
        consultaEstados();
    }
    cargaInicial();

    function consultaEstados() {
        var ppp = $('#id_pais').val();
        if (!ppp) {
            $('#id_estado').html('<option value="">Seleccione un estado</option>');
            $('#id_ciudad').html('<option value="">Seleccione una ciudad</option>');
            return;
        }


        //AJAX
        $.get('../apiPublica/mostrarEstados/' + ppp + '/niveles', function(dataPais) {
            var html_select = '<option value="">Seleccione un estado</option>';
            for (var i = 0; i < dataPais.length; i++) {
                if (dataPais[i].id_estado == $('#id_estado').val()) {
                    html_select += '<option value="' + dataPais[i].id_estado + '" selected>' + dataPais[i].nombre_estado + '</option>';
                } else {
                    html_select += '<option value="' + dataPais[i].id_estado + '">' + dataPais[i].nombre_estado + '</option>';
                }
                $('#id_estado').html(html_select);
            }
            consultaCiudades();
        });

    }

    function consultaCiudades() {

        var ccc = $('#id_estado').val();
        console.log($('#id_estado').val())
        if (!ccc) {
            $('#id_ciudad').html('<option value="">Seleccione una ciudad</option>');
            return;
        }

        //AJAX
        $.get('../apiPublica/mostrarCiudades/' + ccc + '/niveles', function(dataEstado) {
            var html_select = '<option value="">Seleccione una ciudad</option>';
            for (var i = 0; i < dataEstado.length; i++) {
                if (dataEstado[i].id_ciudad == $('#id_ciudad').val()) {
                    html_select += '<option value="' + dataEstado[i].id_ciudad + '" selected >' + dataEstado[i].nombre_ciudad + '</option>';
                } else {
                    html_select += '<option value="' + dataEstado[i].id_ciudad + '" >' + dataEstado[i].nombre_ciudad + '</option>';
                }
                $('#id_ciudad').html(html_select);
            }
        });
    }
    //------------------------------------------------------------------------------------------
    //Boton para ver la edicion del perfil------------------------------------------------------
    const botonEditar = document.getElementById('editarPerfil');
    botonEditar.addEventListener('click', function() {
        // Seleccionar el elemento HTML que se desea reemplazar por su ID
        const seccionActual = document.getElementById('miSeccionActual');

        // Crear una nueva sección HTML
        const nuevaSeccion = document.createElement('div');
        nuevaSeccion.innerHTML = `
                <div id="miSeccionNoActual">
                    <div class="contenido_mayoritario">
                        <div>
                    
                            <p><b>Nombre:</b><br><input name="name" id="name" type="text" required value="{{$dataUser->name}}"></p>

                            <p><b>Género:</b> <br>
                                <select name="gender" id="gender" required>
                                    @if ($dataUser->gender == "Hombre")
                                        <option selected value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                        <option value="Otro">Otro</option>
                                    @endif
                                    @if ($dataUser->gender == "Mujer")
                                        <option value="Hombre">Hombre</option>
                                        <option selected value="Mujer">Mujer</option>
                                        <option value="Otro">Otro</option>
                                    @endif
                                    @if ($dataUser->gender == "Otro")
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                        <option selected value="Otro">Otro</option>
                                    @endif                                   
                                </select>
                            </p>

                            <p><b>Correo: </b> <br><input name="email" id="email" required type="text" value="{{$dataUser->email}}"></p>

                            <p><b>Número:</b><br><input type="number" minlength="10" maxlength="10" id="mobile" value="{{$dataUser->phone }}" name="mobile" placeholder="{{$dataUser->phone ?? 'Sin número'}}">

                        </div>
                        <div>

                            <p><b>Edad:</b><br><input style="width: 30px;" type="number" min="1" max="120" id="age" name="age" required value="{{$dataUser->age}}"> años</p>

                            <p><b>País:</b><br>
                                <select name="pais" id="id_pais" required>
                                    <option value="">Seleccione un pais</option>
                                    @foreach($dataPais as $pais)
                                    @if ($pais->id_pais == $dataUser->ciudades->pais->id_pais)
                                    <option selected value="{{$pais->id_pais}}">{{$pais->nombre_pais}}</option>
                                    @else
                                    <option value="{{$pais->id_pais}}">{{$pais->nombre_pais}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </p>

                            <p><b>Estado:</b><br>
                                <select name="estado" id="id_estado" required>
                                    <option value="{{$dataUser->ciudades->estado->id_estado}}">Seleccione un estado</option>

                                </select>
                            </p>

                            <p><b>Ciudad:</b><br>
                                <select name="ciudad" id="id_ciudad" required>
                                    <option value="{{$dataUser->ciudades->id_ciudad}}">Seleccione una ciudad</option>
                                </select>
                            </p>

                        </div>
                    </div>
                    <p><b>Dirección: </b><input style="width: 525px;" name="address" id="address" type="text" required value="{{$dataUser->address}}" placeholder="{{$dataUser->address ?? 'Sin dirección'}}"></p>
                    <button id='actualizarPerfil' class="botonActualizar">Actualizar datos</button>
                    <button id='volverPerfil' class="botonVolver">Volver</button>

                </div>
        `;
        seccionActual.parentNode.replaceChild(nuevaSeccion, seccionActual);
        botonEditar.style.display = "none";
        volverActualizarPagina();
        cargaInicial();
    });
    //Aqui termina el codigo del boton para ver la edicion del perfil------------------------------------------------------
    let userID = document.getElementById('id_user');
    userID = userID.value;

    function volverActualizarPagina() {
        const botonActualizar = document.getElementById('actualizarPerfil');
        const botonVolver = document.getElementById('volverPerfil');
        botonVolver.addEventListener('click', function() {
            // Seleccionar el elemento HTML que se desea reemplazar por su ID
            const seccionNoActual = document.getElementById('miSeccionNoActual');

            // Crear una nueva sección HTML
            const antiguaSeccion = document.createElement('div');
            antiguaSeccion.innerHTML = `
                <div id="miSeccionActual">
                    <div class="contenido_mayoritario">
                        <div>

                            <p><b>Nombre:</b><br>{{$dataUser->name}}</p>

                            <p><b>Género:</b> <br> {{$dataUser->gender}}</p>

                            <p><b>Correo: </b> <br>{{$dataUser->email}}</p>

                            <p><b>Número:</b><br>{{$dataUser->phone ?? 'Sin número'}}</p>

                        </div>
                        <div>

                            <p><b>Edad:</b><br>{{$dataUser->age}} años</p>

                            <p><b>País:</b><br>{{$dataUser->ciudades->pais->nombre_pais}}</p>

                            <p><b>Estado:</b><br>{{$dataUser->ciudades->estado->nombre_estado}}</p>

                            <p><b>Ciudad:</b><br>{{$dataUser->ciudades->nombre_ciudad}}</p>

                        </div>
                    </div>
                    <p><b>Dirección: </b>{{$dataUser->address ?? 'Sin dirección'}}</p>
                </div>
            `;
            seccionNoActual.parentNode.replaceChild(antiguaSeccion, seccionNoActual);
            botonVolver.style.display = "none";
            botonActualizar.style.display = "none";
            botonEditar.style.display = "block";

        });
        botonActualizar.addEventListener('click', function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = {
                name: jQuery('#name').val(),
                gender: jQuery('#gender').val(),
                email: jQuery('#email').val(),
                phone: jQuery('#phone').val(),
                age: jQuery('#age').val(),
                ciudad: jQuery('#id_ciudad').val(),
                address: jQuery('#address').val(),
            };
            $.ajax({
                type: 'PUT',
                url: '../usuario/update/' + userID,
                data: formData,
                success: function(data) {
                    Swal.fire(
                        'Bien hecho!',
                        'Actualizado correctamente',
                        'success'
                    ).then((result) => {
                        window.location.reload();
                    })

                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salió mal!',
                    })
                }

            });
        });

    }
    //-----------------------------------------------
    /*
        $('#activarInput').click(function() {
            $('#url_imagen').click();
        });*/

    /*
        
        fileInput.addEventListener('change', function(e) {
            e.preventDefault();

            let file = fileInput.files[0];

            if (file && file.type.startsWith('image/')) {
                // El valor del input es una imagen
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'PUT',
                    data: {
                        photo: fileInput.files[0]
                    },
                    processData: false,
                    contentType: false,
                    url: '../usuario/update/' + userID,
                    success: function(data) {
                        Swal.fire(
                            'Bien hecho!',
                            'Actualizado correctamente',
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        })

                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salió mal!',
                        })
                    }

                });
            } else {
                console.log('Por favor sube una imagen');
            }
        });*/
    //------------------
</script>