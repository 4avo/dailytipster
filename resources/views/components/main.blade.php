<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyTipster</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png')}}">
</head>
<body class="bg-gray-800">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center fixed top-0 left-0 w-full z-10 shadow-md">
        <h1 class="text-4xl font-extrabold tracking-wide animated-header flex items-center space-x-2">   
            <span class="text-yellow-400 md:text-4xl">RACK$</span>
            <span class="text-yellow-400"> IN </span>
            <span class="text-yellow-400">BAGS</span>
        </h1>
        <div class="flex items-center">
            <nav>
                @auth
                <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">Profile</a>
                @else
                <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">Join us now</a>
                @endauth
            </nav>
        </div>
    </header>
    {{ $slot }}
</body>
</html>
