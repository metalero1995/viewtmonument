<head>
<link rel="icon" type="image/x-icon" href="{{asset ('img/Isotipo_cerceta.ico') }}">
<link rel="stylesheet" href="{{asset ('css/inicio.css')}}">
<link rel="stylesheet" href="{{asset ('css/global.css')}}">
<title>ViewTMonument</title>

</head>
@include('include.header')

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="../public">
            <img class="w-20 h-20" src="img/Isotipo_cerceta.svg" alt="logotipo">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo electrónico')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Restablecer contraseña') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<?php
    include("../resources/views/include/footer.php");
    ?>
<script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>
