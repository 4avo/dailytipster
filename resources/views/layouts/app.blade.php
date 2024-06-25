<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/user.js') }}"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #121212; /* Dark background color */
            color: #e2e8f0; /* Light text color */
        }
        .min-h-screen {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #ffffff; /* Matching header background color */
        }
        .header-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        main {
            flex: 1;
            padding: 1.5rem 2rem;
            max-width: 1120px;
            margin: 0 auto;
            background-color: #121212; /* Matching main content background color */
            color: #e2e8f0; /* Ensuring text color contrast */
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        .bg-gray-100 {
            background-color: #000000; /* Matching any other background color */
        }
        .font-sans {
            font-family: 'Figtree', sans-serif;
        }
        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        }
        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .text-gray-900 {
            color: #e2e8f0; /* Adjusting text color */
        }
        .text-sm {
            font-size: 0.875rem;
        }
        .text-lg {
            font-size: 1.125rem;
        }
        .text-white {
            color: #fff;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="shadow">
                <div class="header-container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="shadow">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
