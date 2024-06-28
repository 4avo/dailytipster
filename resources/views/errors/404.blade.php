<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 Not Found | Fancy Football Prediction</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/user.js') }}"></script>

    <!-- Custom Styles -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Figtree', sans-serif;
            overflow: hidden;
            background: black; /* Ensure the background is black */
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            text-align: center;
            color: #fff; /* Change text color to white */
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            position: relative;
            z-index: 1;
        }

        .main-content h1 {
            font-size: 3rem;
            display: inline-block;
            position: relative;
            color: #fff; /* Ensure heading is white */
        }

        .main-content p {
            font-size: 1.5rem;
            color: #ccc; /* Light gray for better readability */
            margin: 10px 0;
        }

        .btn-primary {
            padding: 12px 25px;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: #fff;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            margin: 20px auto; /* Center the button */
            display: inline-block;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .btn-primary:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.5s ease;
            border-radius: 50%;
            z-index: 0;
            transform: translate(-50%, -50%) scale(0);
        }

        .btn-primary:hover:before {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes letterMove {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-10px);
            }
        }

        .main-content h1 span {
            display: inline-block;
            animation: letterMove 1s ease-in-out infinite alternate;
        }

        .main-content h1 span:nth-child(odd) {
            animation-delay: 0.2s;
        }

        .header-wrapper {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        #stars {
            position: absolute;
            width: 100%;
            height: 100%;
            background: black;
            overflow: hidden;
            z-index: 0;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            animation: fall 5s linear infinite;
        }

        @keyframes fall {
            0% {
                top: -10px;
                transform: translateX(0);
            }
            100% {
                top: 100vh;
                transform: translateX(100px);
            }
        }
    </style>
</head>
<body>
    <div id="stars"></div>
    <div class="header-wrapper">
        <div class="main-content">
            <h1>
                <span>4</span><span>0</span><span>4</span> - Page Not Found
            </h1>
            <p>Sorry, the page you are looking for does not exist.</p>
            <p>You are currently on: {{ url()->current() }}</p>
            <a href="{{ url('/') }}" class="btn-primary"><span>Go back home</span></a>
        </div>
    </div>

    <script>
        // JavaScript to create falling stars
        function createStars() {
            const starsContainer = document.getElementById('stars');
            for (let i = 0; i < 100; i++) {
                let star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * window.innerWidth + 'px';
                star.style.animationDuration = 2 + Math.random() * 3 + 's';
                starsContainer.appendChild(star);
            }
        }

        createStars();
    </script>
</body>
</html>
