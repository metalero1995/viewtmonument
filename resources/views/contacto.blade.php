<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
    <link rel="stylesheet" href="{{asset ('css/contacto.css')}}">
    <link rel="stylesheet" href="{{asset ('css/global.css')}}">


    <title>ViewTMonument</title>
</head>

<body class="ordenar">
@include('include.header')


    <!--Formulario-->
    <main>
        <div>
            <form id="demo-form2" name="frmregistra" action="{{route('contacto_envioAll')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
                @csrf
                <div class="contenido_principal" id="ingreso">
                    <h2 class="titulo_principal" id="ingreso2">Contáctanos</h2>
                    <div class="contenido_secundario_p1">
                        <label class="parrafos_primarios" for="asunto">Asunto</label>
                        <input class="input" type="text" name="asunto" id="asunto" required>
                        <label class="parrafos_primarios" for="email">E-mail</label>
                        <input class="input" type="email" name="email" id="email" required>
                        <label class="parrafos_primarios" for="descripcion">¿Cómo podemos ayudarte?</label>
                        <textarea maxlength="750" class="input tamaño" type="text" name="descripcion" id="descripcion" required> </textarea>

                    </div>
                    <button onclick="ModalCrear()" type="button" class="submit">Enviar</button>
                    <button hidden name="enviarMensaje" id="enviarMensaje" type="submit"></button>
                    @if (Session::has('success'))

                    <p class="parrafos_primarios" role="">{{ Session::get('success') }}</p>

                    @endif
                </div>
            </form>

        </div>
    </main>
    <!--<script src="dashboard/js/script.js"></script>-->
    <?php
    include("../resources/views/include/footer.php");
    ?>
    <script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>

</body>

</html>
<script>
    function ModalCrear() {
        let cont = 0;

        if (cont == 0) {
            $('#enviarMensaje').trigger('click');
        }

        if ($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {} else {


            //Valida que los campos obligatorios no estén vacios
            if ($('#email').val().length != 0 && $('#asunto').val().length != 0 && $('#descripcion').val().length != 0) {

                //Valida que ningun campo contenga errores señalados
                cont = 1;
                Swal.fire({
                    title: '¡Correo enviado correctamente!',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                })
            }
        }

       
    }
</script>