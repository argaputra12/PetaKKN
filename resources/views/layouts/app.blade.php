<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <link rel="stylesheet" href="resources/css/app.css"> --}}

        <!-- Leaflet js -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

        <!-- Ajax -->
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
        </script>

        <!-- Font awesome -->
        <script src="https://kit.fontawesome.com/0b736e1e36.js" crossorigin="anonymous"></script>

        <!-- csrf token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 750px;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }
        #map {
            width: 80%;
            height: 750px;
            margin: 0 auto;

        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            text-align: left;
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
        </style>


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-primary-textdark ">



            @include('layouts.navigation')

            <!-- Page Heading -->
            <header >
                <div class=" mx-auto sm:px-6 lg:px-36 h-auto pb-4 font-inter">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class=" relative z-10 font-inter">
                {{ $slot }}
            </main>


        </div>

    </body>

</html>
