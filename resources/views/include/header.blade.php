
<header class="seguidor">
    
    <nav class="botones_generales">
        <a href="/" class="logo"><img src="img/Logotipo_cerceta.svg" alt="logotipo"></a>
        <button class="toggle">⚌</button>
        <div class="botonesFormatoFila desplegar_principal">
            <a href="/" class="botonNav">Inicio</a>
            <div class="separador">
                <hr class="lineaVertical">
                </hr>
                <a class="botonNav" href="nosotros">Nosotros</a>
                <hr class="lineaVertical">
                </hr>
            </div>
            <a href="monumentos" class="botonNav">Monumentos</a>
            @if(Auth::user() == null)
            <a href="login" class="botonNav botonInicioSesion">Iniciar sesión</a>
            @elseif(Auth::user()->PerfilID == 1)
            <a href="login" class="botonNav botonInicioSesion">Dashboard</a>
            @elseif(Auth::user()->PerfilID == 2)
            <a href='usuario/{{Auth::user()->id}}' class="botonNav botonInicioSesion"> Perfil </a>
            @endif
        </div>

    </nav>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>