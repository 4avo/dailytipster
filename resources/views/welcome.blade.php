<x-app-layout>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="min-h-screen bg-black text-white py-12 px-6 flex">
        <!-- Prediction Form -->
        <div class="flex-1 flex flex-col">
            <form id="prediction-form" action="{{ route('predictions.store') }}" method="POST" class="w-full max-w-lg bg-black rounded-lg shadow-lg p-8 flex-grow">
                @csrf
                <h1 class="text-4xl font-bold mb-8">Make a prediction</h1>

                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-90"
                         class="bg-green-500 text-white p-4 rounded-lg mb-8 relative">
                        {{ session('success') }}
                        <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-8">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Custom Leagues Dropdown -->
                <div>
                    <label for="leagues" class="block text-lg font-medium mb-2">Leagues:</label>
                    <div class="custom-dropdown relative">
                        <div class="relative flex items-center">
                            <div id="leagues-display" class="flex items-center w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                                <img id="league-logo" src="" alt="" class="w-6 h-6 mr-2 hidden">
                                <span id="league-name" class="flex-1">Select League</span>
                            </div>
                        </div>
                        <div id="leagues-menu" class="custom-dropdown-menu hidden absolute w-full bg-black text-white border border-white rounded-lg mt-1">
                            <ul id="leagues-list">
                                @foreach($leagues as $league)
                                    <li class="custom-dropdown-item p-2 flex items-center cursor-pointer"
                                        data-value="{{ $league['id'] }}"
                                        data-logo="{{ $league['logo'] }}"
                                        data-name="{{ $league['name'] }}"
                                        data-teams="{{ json_encode($league['teams']) }}">
                                        <img src="{{ $league['logo'] }}" alt="{{ $league['name'] }} logo" class="w-6 h-6 mr-2">
                                        {{ $league['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Home Team Dropdown -->
                <div class="mt-6">
                    <label for="home-team" class="block text-lg font-medium mb-2">Home Team:</label>
                    <select id="home-team" name="home_team" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="" disabled selected>Select Home Team</option>
                    </select>
                </div>

                <!-- Away Team Dropdown -->
                <div class="mt-6">
                    <label for="away-team" class="block text-lg font-medium mb-2">Away Team:</label>
                    <select id="away-team" name="away_team" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="" disabled selected>Select Away Team</option>
                    </select>
                </div>

                <!-- Prediction Options -->
                <div class="mt-6">
                    <label class="block text-lg font-medium mb-2">Prediction:</label>
                    <div id="prediction-options" class="flex flex-wrap justify-around mt-4">
                        <button type="button" class="prediction-button" data-value="Team 1 to win">Team 1 to win</button>
                        <button type="button" class="prediction-button" data-value="Draw">Draw</button>
                        <button type="button" class="prediction-button" data-value="Team 2 to win">Team 2 to win</button>
                        <button type="button" class="prediction-button" data-value="Over 2.5 goals">Over 2.5 goals</button>
                        <button type="button" class="prediction-button" data-value="Under 2.5 goals">Under 2.5 goals</button>
                        <button type="button" class="prediction-button" data-value="Both teams to score">Both teams to score</button>
                    </div>
                    <input type="hidden" name="prediction" id="prediction-input" required>
                </div>

                <!-- Description Input -->
                <div class="mt-6">
                    <label for="description" class="block text-lg font-medium mb-2">Description:</label>
                    <textarea id="description" name="description" rows="4" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white" required></textarea>
                </div>

                <!-- Probability Input -->
                <div class="mt-6">
                    <label for="probability" class="block text-lg font-medium mb-2">Probability (%):</label>
                    <input type="number" id="probability" name="probability" min="0" max="100" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-white text-black font-bold py-3 rounded-lg transition duration-300 mt-6">Submit Prediction</button>
            </form>
        </div>

        <!-- Sidebar for Random Predictions -->
        <div class="w-1/3 ml-6">
            <h2 class="font-bold text-xl mb-4">Predictions from the best</h2>
            <ul class="space-y-6">
                @foreach($randomPredictions as $randomPrediction)
                    <li class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold text-lg">
                                    @if($randomPrediction->user)
                                        <strong>{{ $randomPrediction->user->username }}</strong>
                                    @else
                                        <strong>Unknown User</strong>
                                    @endif
                                </div>
                                <div class="text-white mt-2">
                                    {{ $randomPrediction->home_team }} vs {{ $randomPrediction->away_team }}
                                </div>
                                <div class="text-white mt-2">
                                    {{ $randomPrediction->prediction }}
                                </div>
                                @if($randomPrediction->description)
                                    <div class="text-white mt-2">
                                        <strong>Description:</strong> {{ $randomPrediction->description }}
                                    </div>
                                @endif
                                @if($randomPrediction->probability)
                                    <div class="text-white mt-2">
                                        <strong>Probability:</strong> {{ $randomPrediction->probability }}%
                                    </div>
                                @endif
                                <div class="text-gray-200 text-sm mt-2">
                                    {{ $randomPrediction->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>