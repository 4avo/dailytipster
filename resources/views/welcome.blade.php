<x-main>
    <div class="flex items-center">
        <nav>
            @auth
            <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">You are logged in</a>
            @else
            <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">Join us now</a>
            @endauth
        </nav>
    </div>
 <div class="mt-24 flex"> <!-- Adjust the top margin to account for the fixed header -->
        <div class="w-1/4 px-4">
            <h2 class="text-white text-xl mb-4">Our top predictors</h2>
            @foreach ($users as $user)
                <div class="leaderboard-item left">
                    <span class="rank">{{ $loop->iteration }}.</span>
                    <span class="username">{{ $user->name }}</span>
                </div>
            @endforeach
        </div>

        <section class="main-content w-1/2 px-4">
            <div class="feature mb-4">
                <h2>Compete and win</h2>
                <p>Our website is a challenge for every football fan. If you want to compete with others and win exclusive rewards, join us now and start predicting the outcomes of the upcoming matches.</p>
                <img src="{{ asset('images/compete.png') }}" alt="Profile pic" class="w-full h-full object-cover">
            </div>

            <div class="feature mb-4">
                <h2>Our Mission</h2>
                <p>Our application allows users to compete against each other by predicting football match outcomes. We've created a platform that offers a safe and enjoyable alternative to traditional betting, encouraging sports enthusiasts to test their prediction skills in a friendly, competitive environment. By promoting strategic thinking and sports knowledge, we aim to help users make informed predictions and foster a community of passionate football fans.</p>
                <img src="{{ asset('images/leagues.png') }}" alt="Profile pic" class="w-full h-full object-cover">
            </div>

            <div class="feature mb-4">
                <h2>Join Our Community</h2>
                <p>Explore our curated collection and join a community of fashion enthusiasts who appreciate the artistry behind each piece.</p>
                <a href="/join" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400 mt-4 inline-block">Start Exploring</a>
            </div>
        </section>

        <div class="w-1/4 px-4">
            <h2 class="text-white text-xl mb-4">Today's Top Predictions</h2>
            <div class="predictions-item">
                <div class="match">Team A vs. Team B</div>
                <div class="outcome">Prediction: Team A wins</div>
            </div>
            <div class="predictions-item">
                <div class="match">Team C vs. Team D</div>
                <div class="outcome">Prediction: Draw</div>
            </div>
            <div class="predictions-item">
                <div class="match">Team E vs. Team F</div>
                <div class="outcome">Prediction: Team F wins</div>
            </div>
        </div>
    </main>
 </div>
</x-main>
