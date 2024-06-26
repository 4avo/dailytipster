<x-app-layout>
    <div class="min-h-screen bg-black text-white py-12 px-6 flex items-start justify-center relative overflow-hidden">
        <div class="w-full max-w-2xl bg-gray-800 text-white rounded-lg shadow-lg p-8 mt-8 relative z-10">
            <h1 class="text-4xl font-bold mb-8 text-center">Leaderboard</h1>
            
            @php
                $currentUser = auth()->user();
                $currentUserRank = null;
                $creditsNeeded = null;
                $previousUser = null;
            @endphp
            
            @foreach($users as $index => $user)
                @if($user->id == $currentUser->id)
                    @php
                        $currentUserRank = $index + 1;
                        if (isset($previousUser)) {
                            $creditsNeeded = $previousUser->credits - $currentUser->credits + 1;
                        }
                    @endphp
                @endif
                @php
                    $previousUser = $user;
                @endphp
            @endforeach

            {{-- Fancy Debug Information --}}
            <div class="bg-gradient-to-r from-gray-700 to-gray-900 text-white p-6 mb-8 rounded-lg shadow-lg flex justify-between items-center">
                <div>
                    <p class="text-lg font-bold mb-2">Your rank is: <span class="text-yellow-400">{{ $currentUserRank }}</span></p>
                    <p class="text-lg font-bold">Credits Needed: <span class="text-yellow-400">{{ $creditsNeeded }}</span></p>
                </div>
                @if($currentUserRank && $currentUserRank <= 3)
                    <div class="text-6xl text-yellow-400 font-bold">S</div>
                @endif
            </div>

            <ul>
                @foreach($users as $user)
                    <li class="flex justify-between items-center mb-4 p-4 rounded-lg transition {{ $loop->first ? 'bg-yellow-500 text-black border-4 border-yellow-400 shadow-lg top-user' : 'bg-gray-700 hover:bg-gray-600' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 {{ $loop->first ? 'bg-yellow-400 rank' : 'bg-gray-600' }} rounded-full flex items-center justify-center text-lg font-bold mr-4">
                                {{ $loop->iteration }}
                            </div>
                            <span class="text-xl">{{ $user->username }}</span>
                        </div>
                        <span class="text-xl font-semibold">{{ $user->credits }} credits</span>
                    </li>
                @endforeach
            </ul>
        </div>

        @if($currentUserRank && $currentUserRank > 1)
            <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md z-10">
                <span>Credits needed to climb the leaderboard: {{ $creditsNeeded }}</span>
            </div>
        @endif

        <div class="falling-stars"></div>
    </div>

    <style>
        .top-user {
            background-color: #FFD700; /* Gold */
            color: black;
            border: 4px solid #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        .top-user .rank {
            background-color: #FFA500; /* Darker gold for rank */
        }
        .falling-stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
        .star {
            position: absolute;
            width: 10px;
            height: 10px;
            background: yellow;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            opacity: 0;
            animation: fall linear infinite;
        }
        @keyframes fall {
            0% {
                transform: translateY(-100%);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
        .exploding-star {
            position: absolute;
            width: 10px;
            height: 10px;
            background: yellow;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            opacity: 0;
            animation: explode 1s ease-out forwards;
        }
        @keyframes explode {
            0% {
                transform: scale(1) translate(0, 0);
                opacity: 1;
            }
            100% {
                transform: scale(2) translate(var(--translate-x), var(--translate-y));
                opacity: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fallingStarsContainer = document.querySelector('.falling-stars');
            for (let i = 0; i < 50; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.left = `${Math.random() * 100}%`;
                star.style.animationDuration = `${Math.random() * 3 + 2}s`;
                star.style.animationDelay = `${Math.random() * 5}s`;
                fallingStarsContainer.appendChild(star);
            }

            document.addEventListener('click', (event) => {
                for (let i = 0; i < 20; i++) {
                    const explodingStar = document.createElement('div');
                    explodingStar.classList.add('exploding-star');
                    explodingStar.style.left = `${event.clientX}px`;
                    explodingStar.style.top = `${event.clientY}px`;
                    explodingStar.style.setProperty('--translate-x', `${Math.random() * 200 - 100}px`);
                    explodingStar.style.setProperty('--translate-y', `${Math.random() * 200 - 100}px`);
                    document.body.appendChild(explodingStar);

                    setTimeout(() => {
                        explodingStar.remove();
                    }, 1000); // Remove the star after the animation
                }
            });
        });
    </script>
</x-app-layout>
