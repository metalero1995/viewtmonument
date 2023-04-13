<head>
    <link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
    <link rel="stylesheet" href="{{asset ('css/inicio.css')}}">
    <link rel="stylesheet" href="{{asset ('css/global.css')}}">
    <title>ViewTMonument</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
@include('include.header')

<x-guest-layout>
    <div style="margin-bottom: 30px; margin-top: 30px;">
        <x-auth-card>
            <x-slot name="logo">
                <a href="../public">
                    <img class="w-20 h-20" src="img/Isotipo_cerceta.svg" alt="logotipo">
                </a>
            </x-slot>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Age -->
                <div class="mt-4">
                    <x-input-label for="age" :value="__('Edad')" />

                    <x-text-input min="1" max="120" id="age" class="block mt-1 w-full" type="number" name="age" required />

                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                </div>

                <!-- Gender -->
                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Género')" />

                    <select class="block mt-1 w-full" name="gender" id="gender" required>
                        <option value="">Elige un género</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Otro">Otro</option>
                    </select>

                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                </div>

                <!-- Country -->
                <div class="mt-4">
                    <x-input-label for="pais" :value="__('Pais')" />

                    <select class="block mt-1 w-full" name="pais" id="id_pais2" required>
                        <option value="">Seleccione un pais</option>
                        @foreach($dataPais as $pais)
                        <option value="{{$pais->id_pais}}">{{$pais->nombre_pais}}</option>

                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                <!-- State -->
                <div class="mt-4" id='estadito'>
                    <x-input-label for="estado" :value="__('Estado')" />

                    <select class="block mt-1 w-full" name="estado" id="id_estado2" required>
                        <option value="">Seleccione un estado</option>
                    </select>

                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                <!-- City -->
                <div class="mt-4" id='ciudadcita'>
                    <x-input-label for="ciudad" :value="__('Ciudad')" />

                    <select class="block mt-1 w-full" name="ciudad" id="id_ciudad2" required>
                        <option value="">Seleccione una ciudad</option>
                    </select>

                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!-- Profile -->
                <x-text-input id="profile" type="hidden" name="profile" value="2" />

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('¿Ya tienes cuenta?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>


            </form>
        </x-auth-card>
    </div>
</x-guest-layout>
<?php
include("../resources/views/include/footer.php");
?>
<script>
    $(window).on("load", function() {
        $('#id_pais2').on('change', consultaEstados);
        $('#id_estado2').on('change', consultaCiudades);
        $('#estadito').hide();
        $('#ciudadcita').hide();
    });

    function consultaEstados() {
        $('#estadito').show();
        var ppp = $('#id_pais2').val();

        if (!ppp) {
            //$('#id_estado2').html('<option value="">Seleccione un estado</option>');
            $('#estadito').hide();
            return;
        }
        $('#ciudadcita').hide();

        //AJAX
        $.get('apiPublica/mostrarEstados/' + ppp + '/niveles', function(dataPais) {
            //var html_select;
            var html_select = '<option value="">Seleccione un estado</option>';
            for (var i = 0; i < dataPais.length; i++)

                html_select += '<option value="' + dataPais[i].id_estado + '" @if( old ("' + id_estado + '")==' + $dataPais[i].id_estado + ') selected @endif >' + dataPais[i].nombre_estado + '</option>';
            $('#id_estado2').html(html_select);
        });

    }

    function consultaCiudades() {
        $('#ciudadcita').show();
        var ccc = $('#id_estado2').val();

        if (!ccc) {
            //$('#id_estado2').html('<option value="">Seleccione un estado</option>');
            $('#ciudadcita').hide();
            return;
        }

        //AJAX
        $.get('apiPublica/mostrarCiudades/' + ccc + '/niveles', function(dataEstado) {
            //var html_select;
            var html_select = '<option value="">Seleccione una ciudad</option>';
            for (var i = 0; i < dataEstado.length; i++)

                html_select += '<option value="' + dataEstado[i].id_ciudad + '" @if( old ("' + id_ciudad + '")==' + $dataEstado[i].id_ciudad + ') selected @endif >' + dataEstado[i].nombre_ciudad + '</option>';
            $('#id_ciudad2').html(html_select);
        });

    }
</script>
<script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>