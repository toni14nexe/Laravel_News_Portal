<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>News Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>
    <style>
        header,
        main {
            margin: 0.5rem 5rem;
            background-color: rgba(255, 255, 255, 0.08);
            color: white;
            padding: 0.5rem;
        }

        .title {
            font-weight: 700;
            font-size: x-large;
        }

        .centered {
            width: 100%;
            display: grid;
            align-items: center;
            justify-content: center;
            justify-items: center;
        }

        .header-padding-fix {
            padding-left: 1.75rem;
            padding-right: 1.75rem;
        }
    </style>
    <body class="font-sans antialiased">
        <div
            class="bg-dots-darker dark:bg-dots-lighter min-h-screen items-center justify-center bg-gray-100 bg-center p-2 selection:bg-red-500 selection:text-white dark:bg-gray-900"
        >
            @include("layouts.navigation")

            <!-- Page Heading -->
            @if (isset($header))
                <header class="title header-padding-fix">{{ $header }}</header>
            @endif

            <!-- Page carousel -->
            @if (isset($carousel))
                <header class="header-padding-fix">{{ $carousel }}</header>
            @endif

            <!-- Page Content -->
            <main>{{ $slot }}</main>

            <!-- Pagination -->
            @if (isset($pagination))
                <header>
                    <div class="centered">
                        {{ $pagination }}
                    </div>
                </header>
            @endif

            <header>
                <div class="centered">
                    <x-login-footer />
                </div>
            </header>
        </div>
    </body>
</html>
