<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-cover-screen {
            background-image: url('{{ asset('assets/img/bghome.png') }}');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh;
        }

    </style>
</head>
<body>
<div class="bg-cover-screen">
    <div>
        <header class="grid grid-cols-2 mx-32">
            <div class="flex gap-x-4">
                <img src="{{ asset("assets/img/logo.png") }}" class="my-8 h-20 w-20" alt="Logo"/>
                <p class="font-bold text-3xl text-white my-auto">Locauto</p>
            </div>
            <div class="ml-auto text-white flex gap-x-16 my-12 text-xl">
                <a href="#" class="relative text-xl w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-white after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-left">
                    Accueil</a>
                <a href="#" class="relative text-xl w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-white after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-left">
                    Voitures</a>
                <a href="#" class="relative text-xl w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-white after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-left">
                    Contact</a>
                <a href="#" class="relative text-xl w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-white after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-left">
                    Connexion/Crée un compte</a>
            </div>
        </header>
        <div class="ml-96 mt-24">
            <h1 class="text-5xl font-bold text-white">
                Louez votre voiture<br>éléctrique
            </h1>
            <h2 class="text-xl font-semibold text-white opacity-50">
                Conduisez l'avenir dès aujourd'hui
            </h2>
            <div class="mt-4">
                <a href="/vehicles" class="duration-500 hover:opacity-50 bg-white text-purple-700 font-bold py-2 px-4 rounded-full mr-4">
                    Voir les véhicules
                </a>
                <a href="#concept" class="duration-500  hover:opacity-50 bg-purple-700 text-white font-bold py-2 px-4 rounded-full">
                    En savoir plus
                </a>
            </div>
        </div>

    </div>
    <div class="absolute bottom-0 inset-x-0 text-center mb-8 text-white">
        <div class="animate-bounce bg-button-violet inline-block p-4 rounded-full">
            <x-heroicon-o-arrow-down class="h-8 w-8 mx-auto rounded-full"/>
        </div>
    </div>
</div>
<div id="concept"> </div>
</body>
</html>
