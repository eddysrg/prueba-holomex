<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="py-5 bg-blue-100 px-8 flex justify-end items-center">

        <div class="flex gap-4">
            <a class="bg-blue-500 px-4 py-2 rounded text-white font-medium" href="{{route('login')}}">Iniciar Sesión</a>
        </div>
    </header>

    <div class="w-full py-40 flex flex-col gap-6 justify-center items-center">
        <h1 class="text-5xl">¡Hola <span class="text-blue-500">mundo!</span></h1>
        <p class="text-2xl">Bienvenido a esta prueba de login utilizando laravel y php</p>
        <p>Ingresa al CRUD con el botón Iniciar Sesión del lado superior derecho las credenciales son: </p>
        <p>
            <span class="font-bold text-blue-500">correo@correo.com</span> y la contraseña <span
                class="font-bold text-blue-500">password</span>
        </p>
    </div>

    <footer
        class="bg-blue-300 py-10 flex flex-col justify-center items-center text-white font-semibold bottom-0 absolute w-full">
        <p>Made by Eduardo Ramírez Galindo</p>
        <p id="reloj"></p>
    </footer>
</body>

</html>