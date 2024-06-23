<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes slideLeft {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0);
            }
        }
        .animated-header {
            animation: slideLeft 1s ease-out;
        }
        .main-content {
            max-width: 800px;
            margin: 40px auto; /* Increased margin for more space */
            padding: 20px;
            text-align: center;
            background-color: #2d2d2d; /* Matched with bg-gray-800 */
            color: white; /* Text color for contrast */
            border-radius: 8px; /* Rounded corners for the content */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for depth */
        }
        .feature {
            margin-bottom: 40px;
        }
        .feature h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .feature p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #ddd; /* Lighter text color for better readability */
        }
        .feature img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
        }
        .left-column,
        .right-column {
            flex: 1;
            padding: 20px;
            background-color: #2d2d2d; /* Darker background for columns */
            border-radius: 8px; /* Rounded corners for columns */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for depth */
            color: white; /* Text color for contrast */
        }
        .left-column {
            margin-right: 20px; /* Space between columns */
        }
        .upcoming-matches {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .upcoming-matches li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #333; /* Dark background for match items */
            border-radius: 4px;
        }
        .upcoming-matches li span {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-4xl font-extrabold tracking-wide animated-header flex items-center space-x-2">   
            <span class="text-yellow-400 md:text-4xl">RACK$</span>
            <span class="text-yellow-400"> IN </span>
            <span class="text-yellow-400">BAGS</span>
        </h1>
        <div class="flex items-center">
            <nav>
                <a href="/join" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">Join us now</a>
            </nav>
        </div>
    </header>

    <main class="mt-6 flex justify-between">
        <div class="left-column">
            <h2>Upcoming Football Matches</h2>
            <ul class="upcoming-matches">
                <li><span>June 25, 2024</span> - Team A vs. Team B</li>
                <li><span>June 26, 2024</span> - Team C vs. Team D</li>
                <li><span>June 27, 2024</span> - Team E vs. Team F</li>
                <!-- Add more match items as needed -->
            </ul>
        </div>

        <div class="right-column">
            <h2>Leaderboard</h2>
            <div>
                <!-- Placeholder for leaderboard content -->
                <p>Leaderboard content goes here...</p>
            </div>
        </div>
    </main>

    <section class="main-content mt-6">
        <div class="feature">
            <h2>Compete and win</h2>
            <p>Our website is a challenge for every football fan. If you want to compete with others and win exclusive rewards, join us now and start predicting the outcomes of the upcoming matches.</p>
            <img src="{{ asset('images/compete.png') }}" alt="Profile pic" class="w-full h-full object-cover">
        </div>

        <div class="feature">
            <h2>Our Mission</h2>
            <p>Our application allows users to compete against each other by predicting football match outcomes. We've created a platform that offers a safe and enjoyable alternative to traditional betting, encouraging sports enthusiasts to test their prediction skills in a friendly, competitive environment. By promoting strategic thinking and sports knowledge, we aim to help users make informed predictions and foster a community of passionate football fans.</p>
            <img src="{{ asset('images/leagues.png') }}" alt="Profile pic" class="w-full h-full object-cover">

        </div>

        <div class="feature">
            <h2>Join Our Community</h2>
            <p>Explore our curated collection and join a community of fashion enthusiasts who appreciate the artistry behind each piece.</p>
            <a href="/join" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400 mt-4 inline-block">Start Exploring</a>
        </div>
    </section>

    <footer class="bg-gray-800 text-white p-4 mt-6 text-center">
        <p>&copy; 2024 Our Website. All rights reserved.</p>
    </footer>
</body>
</html>
