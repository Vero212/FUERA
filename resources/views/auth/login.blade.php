<style>
    body {
        font-family: 'Figtree', sans-serif;
        background: linear-gradient(to bottom, #fff5e6, #ffe6b2); /* Fondo amarillo claro degradado */
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .header {
        display: flex; /* Activa el flexbox */
    align-items: center; /* Alinea los elementos verticalmente al centro */
    }

    .header h1 {
    font-size: 30px; /* Tamaño de la fuente */
    background: linear-gradient(90deg, yellow, black); /* Sombreado con dos colores */
    -webkit-background-clip: text; /* Clip del fondo para que el color se aplique al texto */
    -webkit-text-fill-color: transparent; /* Hace que el relleno del texto sea transparente */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra del texto */
    margin: 10; /* Sin margen */
}

    .logo {
    width: 80px; /* Ajusta el tamaño de la imagen según sea necesario */
    height: auto; /* Mantiene la proporción de la imagen */
    margin-right: 10px; /* Espacio entre la imagen y el texto */
    }

    h1 {
        font-size: 2.5rem;
        color: #333; /* Color del texto del título */
    }
</style>

<x-guest-layout>
    <div class="container">
        <div class="container">
            <div class="header flex items-center"> <!-- Agrega 'flex' y 'items-center' aquí -->
                <img src="{{ asset('img/iconos/radiacion.png') }}" alt="Logo de Radiación" class="logo mr-2"> <!-- Agrega 'mr-2' para un margen a la derecha -->
                <h1>Fuentes Radiactivas</h1>
            </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
