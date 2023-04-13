<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>ViewTMonument</title>
    <link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
    <link rel="stylesheet" href="{{asset ('css/nosotros.css')}}">
    <link rel="stylesheet" href="{{asset ('css/global.css')}}">
</head>

<body>
@include('include.header')

    <main>
        <div>
            <div class="contenedor_imagen">
                <div class="escenario_principal">
                    <h2 class="texto_principal">Acerca de nosotros</h2>
                </div>
            </div>
        </div>
        <div class="escenario_secundario">
            <h3 class="titulo_secundario">Conoce ViewTMonument</h3>
            <p class="parrafo_secundario">
                La idea de ViewTMonument fue concebida por nuestros cofundadores, quienes detectaron una necesidad en nuestra ciudad: la falta de conexión entre los turistas y la cultura local. Con el objetivo de fomentar la cultura y atraer a más visitantes, creamos ViewTMonument, una aplicación móvil innovadora que combina la inteligencia artificial, la ciencia de datos y una interfaz fácil de usar para personalizar la experiencia del usuario. Con ViewTMonument, queremos ofrecer una forma emocionante e interactiva de explorar y descubrir los monumentos de nuestra ciudad.            </p>
        </div>
        <div>
            <div class="escenario_terciario_izquierda">
                <img class="info_imagenes" src="{{asset ('img/raul_foto_final.png')}}" alt="">
                <div class="contenedor_texto_izquierda">
                    <p class="pre_titulo_terciario">Gestor de base de datos</p>
                    <h3 class="titulo_terciario">Raul de la Rosa Gamboa</h3>
                    <p class="post_titulo_terciario">Como gestor de base de datos me encargué de la realización de consultas y del análisis para generar informes.</p>
                </div>
            </div>
        </div>
        <div>
            <div class="escenario_terciario_derecha">
                <img class="info_imagenes" src="{{asset ('img/angel_foto_final.png')}}" alt="">
                <div class="contenedor_texto_derecha">
                    <p class="pre_titulo_terciario">Documentador/Programador</p>
                    <h3 class="titulo_terciario">Angel Celis Canul</h3>
                    <p class="post_titulo_terciario">Como documentador me encargué que podamos tener todos los documentos necesarios para el proyecto, además de apoyar en la parte de desarrollo web.</p>
                </div>
            </div>
        </div>
        <div>
            <div class="escenario_terciario_izquierda">
                <div>
                    <img class="info_imagenes" src="{{asset ('img/leo_foto_final.png')}}" alt="">
                </div>
                <div class="contenedor_texto_izquierda">
                    <p class="pre_titulo_terciario">Director de proyecto</p>
                    <h3 class="titulo_terciario">Leonardo Pasos Carrillo</h3>
                    <p class="post_titulo_terciario">Como director de proyecto me hice responsable de la gestión del proyecto, de la consecución de los objetivos, los plazos y los requisitos de calidad.</p>
                </div>
            </div>
        </div>
        <div>
            <div class="escenario_terciario_derecha">
                <div>
                    <img class="info_imagenes" src="{{asset ('img/jeroan_foto_final.png')}}" alt="">
                </div>
                <div class="contenedor_texto_derecha">
                    <p class="pre_titulo_terciario">Programador backend</p>
                    <h3 class="titulo_terciario">Jeroan Rosas Loeza</h3>
                    <p class="post_titulo_terciario">Como programador web, me encargué de desarrollar el dashboard con todas las funcionalidades que contiene, además de realizar la conexión con la base de datos.</p>
                </div>
            </div>
        </div>
        <div>
            <div class="escenario_terciario_izquierda">
                <div>
                    <img class="info_imagenes" src="{{asset ('img/jose_foto_final.png')}}" alt="">
                </div>
                <div class="contenedor_texto_izquierda">
                    <p class="pre_titulo_terciario">Documentador</p>
                    <h3 class="titulo_terciario">José Olvera Pech</h3>
                    <p class="post_titulo_terciario">Encargado en parte de la documentacion del proyecto, tal como la elaboración de la descripción de casos de uso y la documentación de la instalación de los servicios de mysql en nuestro servidor.</p>
                </div>
            </div>
        </div>
        <div>
    </main>
    <?php
    include("../resources/views/include/footer.php");
    ?>
    <script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>
</body>

</html>