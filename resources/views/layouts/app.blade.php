<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Distance') }}</title>


    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div id="app">
        @livewire('parts.nav')

        <main class="main">

            <div class="top">

                <button class="toggle-button">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="header">
                    <a href="{{ route('home') }}"><i class="fas fa-book-reader"></i>DISTANCE</a>
                </div>

                <div class="fixer">
                </div>

            </div>
            {{ $slot }}

        </main>

    </div>
    @livewireScripts

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!---------------- JQuery ---------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</body>

</html>
