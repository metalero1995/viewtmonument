
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

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo electrónico')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label style="display:flex;justify-content: space-between;" for="remember_me" class="inline-flex items-center">
                    <div>
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                    </div>

                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                    @endif
                </label>

            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">¿Sin cuenta? ¡Regístrate!</a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Iniciar sesión') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<?php
    include("../resources/views/include/footer.php");
    ?>
<script language="JavaScript" type="text/javascript" src="{{asset ('js/global.js')}}"></script>
