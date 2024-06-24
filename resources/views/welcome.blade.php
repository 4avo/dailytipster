<x-main>
    <div class="flex items-center">
        <nav>
            @auth
            @php
                $loggedInUsername = auth()->user()->username;
                $isInLeaderboard = false;
            @endphp

            @foreach ($users as $user)
                @if ($user->username === $loggedInUsername)
                    @php $isInLeaderboard = true; @endphp
                    <a href="/profile" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">
                        {{ $user->username }} (Username: Me)
                    </a>
                    @break
                @endif
            @endforeach

            @unless ($isInLeaderboard)
                <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">
                    You are logged in
                </a>
            @endunless

            @else
            <a href="/register" class="text-lg md:text-xl text-yellow-400 hover:text-white border-2 border-yellow-400 py-2 px-4 rounded-full transition duration-300 ease-in-out hover:bg-yellow-400">
                Join us now
            </a>
            @endauth
        </nav>
    </div>
    <div class="mt-24 flex">
        <!-- Display leaderboard -->
        <div class="w-1/4 px-4">
            <h2 class="text-white text-3xl font-extrabold mb-4 tracking-wider uppercase bg-clip-text text-transparent bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">LEADERBOARD</h2>
            @foreach ($users as $user)
                <div class="leaderboard-item left {{ $loop->first ? 'leader' : ($loop->iteration == 2 ? 'runner-up' : '') }} mb-2 p-4 border border-gray-500 rounded-lg bg-gray-800 hover:bg-gray-700 transition duration-300 ease-in-out">
                    <span class="rank text-yellow-400 text-lg font-semibold">
                        @if($loop->first)
                            Leader
                        @elseif($loop->iteration == 2)
                            Runner-up
                        @else
                            {{ $loop->iteration . '.' }}
                        @endif
                    </span>
                    <span class="username text-white text-xl ml-2">
                        @if ($user->username === $loggedInUsername)
                            {{ $user->username }} (You)
                        @else
                            {{ $user->username }}
                        @endif
                    </span>
                    @if($loop->first)
                        <div class="stars flex mt-2">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="star w-6 h-6 bg-yellow-400 rounded-full mx-1"></div>
                            @endfor
                        </div>
                    @endif
                </div>
            @endforeach
        </div>


        <div class="w-3/4 px-4">
            <h2 class="text-white text-3xl font-extrabold mb-4 tracking-wider uppercase bg-clip-text text-transparent bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">LEAGUES</h2>
            <div class="league-list grid grid-cols-2 gap-4">
                @forelse ($leagues['data'] as $league)
                    <div class="league-item mb-4 p-4 border border-gray-500 rounded-lg bg-gray-800 hover:bg-gray-700 transition duration-300 ease-in-out">
                        <h3 class="text-yellow-400 text-lg font-semibold">{{ $league['name'] }}</h3>
                        <!-- Display other league data as needed -->
                    </div>
                @empty
                    <p>No leagues found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-main>
