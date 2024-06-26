<!-- resources/views/welcome.blade.php -->
<x-app-layout>
    <div class="min-h-screen bg-black text-white py-12 px-6 flex items-start justify-start">
        <form action="{{ route('predictions.store') }}" method="POST" class="w-full max-w-lg bg-black rounded-lg shadow-lg p-8">
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

            <!-- Custom Leagues Dropdown -->
            <div>
                <label for="leagues" class="block text-lg font-medium mb-2">Leagues:</label>
                <div class="custom-dropdown relative">
                    <div class="relative flex items-center">
                        <div id="leagues-display" class="flex items-center w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                            <img id="league-logo" src="" alt="" class="w-6 h-6 mr-2 hidden">
                            <span id="league-name" class="flex-1">Select League</span>
                            <span id="country-code" class="ml-2 hidden"></span>
                            <img id="country-flag" src="" alt="" class="w-6 h-6 ml-1 hidden" data-tooltip="">
                        </div>
                    </div>
                    <div id="leagues-menu" class="custom-dropdown-menu hidden absolute w-full bg-black text-white border border-white rounded-lg mt-1">
                        <ul id="leagues-list">
                            @foreach($leagues as $league)
                                <li class="custom-dropdown-item p-2 flex items-center cursor-pointer"
                                    data-value="{{ $league['id'] }}"
                                    data-logo="{{ $league['logo'] }}"
                                    data-name="{{ $league['name'] }}"
                                    data-country-code="{{ $league['country_code'] ?? '' }}"
                                    data-country-flag="{{ $league['country_flag'] ?? '' }}"
                                    data-country-name="{{ $league['country_name'] ?? '' }}">
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
                <input type="hidden" name="prediction" id="prediction-input">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-white text-black font-bold py-3 rounded-lg transition duration-300 mt-6">Submit Prediction</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const leaguesDisplay = document.getElementById('leagues-display');
            const leagueLogo = document.getElementById('league-logo');
            const leagueName = document.getElementById('league-name');
            const countryCode = document.getElementById('country-code');
            const countryFlag = document.getElementById('country-flag');
            const leaguesMenu = document.getElementById('leagues-menu');
            const customDropdownItems = document.querySelectorAll('.custom-dropdown-item');
            const homeTeamDropdown = document.getElementById('home-team');
            const awayTeamDropdown = document.getElementById('away-team');
            const predictionButtons = document.querySelectorAll('.prediction-button');
            const predictionInput = document.getElementById('prediction-input');

            const teamsData = @json($teamsData); // Include teams data from the controller

            leaguesDisplay.addEventListener('click', function () {
                leaguesMenu.classList.toggle('hidden');
            });

            customDropdownItems.forEach(item => {
                item.addEventListener('click', function () {
                    const logo = item.getAttribute('data-logo');
                    const name = item.getAttribute('data-name');
                    const code = item.getAttribute('data-country-code');
                    const flag = item.getAttribute('data-country-flag');
                    const countryName = item.getAttribute('data-country-name');
                    
                    leagueLogo.src = logo;
                    leagueLogo.alt = `${name} logo`;
                    leagueLogo.classList.remove('hidden');
                    
                    leagueName.textContent = name;
                    
                    if (code) {
                        countryCode.textContent = code;
                        countryCode.classList.remove('hidden');
                    } else {
                        countryCode.classList.add('hidden');
                    }
                    
                    if (flag) {
                        countryFlag.src = flag;
                        countryFlag.alt = `${code} flag`;
                        countryFlag.dataset.tooltip = countryName; // Use data attribute for custom tooltip
                        countryFlag.classList.remove('hidden');
                    } else {
                        countryFlag.classList.add('hidden');
                    }
                    
                    leaguesDisplay.dataset.value = item.dataset.value;
                    leaguesMenu.classList.add('hidden');

                    // Update home and away team dropdowns
                    const leagueTeams = teamsData[name] || [];
                    homeTeamDropdown.innerHTML = '<option value="" disabled selected>Select Home Team</option>';
                    awayTeamDropdown.innerHTML = '<option value="" disabled selected>Select Away Team</option>';
                    leagueTeams.forEach(team => {
                        const option = document.createElement('option');
                        option.value = team;
                        option.textContent = team;
                        homeTeamDropdown.appendChild(option.cloneNode(true));
                        awayTeamDropdown.appendChild(option);
                    });

                    // Trigger change event for further processing if needed
                    leaguesDisplay.dispatchEvent(new Event('change'));
                });
            });

            document.addEventListener('click', function (event) {
                if (!leaguesDisplay.contains(event.target) && !leaguesMenu.contains(event.target)) {
                    leaguesMenu.classList.add('hidden');
                }
            });

            // Disable same team in the other dropdown
            function disableSameTeam(selectedTeam, targetDropdown) {
                Array.from(targetDropdown.options).forEach(option => {
                    option.disabled = option.value === selectedTeam;
                });
            }

            homeTeamDropdown.addEventListener('change', function () {
                disableSameTeam(this.value, awayTeamDropdown);
            });

            awayTeamDropdown.addEventListener('change', function () {
                disableSameTeam(this.value, homeTeamDropdown);
            });

            // Prediction button click event
            predictionButtons.forEach(button => {
                button.addEventListener('click', function () {
                    predictionButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    predictionInput.value = this.getAttribute('data-value');
                });
            });
                           // Tooltip functionality
                           document.addEventListener('mouseover', function (event) {
                   if (event.target.matches('[data-tooltip]')) {
                       const tooltipText = event.target.dataset.tooltip;
                       const tooltip = document.createElement('div');
                       tooltip.className = 'custom-tooltip';
                       tooltip.textContent = tooltipText;
                       document.body.appendChild(tooltip);

                       const rect = event.target.getBoundingClientRect();
                       tooltip.style.left = `${rect.left + window.scrollX}px`;
                       tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 5}px`;

                       event.target.addEventListener('mouseleave', function () {
                           tooltip.remove();
                       }, { once: true });
                   }
               });
           });
       </script>

       <style>
           .custom-dropdown {
               position: relative;
           }

           .custom-dropdown-menu {
               max-height: 200px;
               overflow-y: auto;
               z-index: 10;
           }

           .custom-dropdown-item:hover {
               background-color: #333;
           }

           #leagues-display {
               background: none;
               border: none;
               color: white;
               width: 100%;
               display: flex;
               align-items: center;
           }

           #country-code {
               margin-left: 1rem; /* Adjust margin to move the country code to the left */
           }

           #country-flag {
               margin-left: 0.5rem; /* Adjust margin to move the flag to the left */
           }

           /* Custom Tooltip Styles */
           .custom-tooltip {
               position: absolute;
               background-color: #333;
               color: #fff;
               padding: 5px 10px;
               border-radius: 4px;
               font-size: 12px;
               z-index: 1000;
           }

           /* Prediction Button Styles */
           .prediction-button {
               background-color: #333;
               color: white;
               border: 2px solid white;
               border-radius: 0.375rem;
               padding: 0.75rem 1.5rem;
               cursor: pointer;
               transition: background-color 0.3s, transform 0.3s;
               flex: 1 1 calc(33% - 1rem); /* Allow buttons to wrap */
               margin: 0.5rem;
               text-align: center;
           }

           .prediction-button:hover {
               background-color: white;
               color: black;
               transform: scale(1.05);
           }

           .prediction-button.active {
               background-color: #FFD700; /* Gold color for active button */
               border-color: #FFD700; /* Match border color */
               color: black;
               transform: scale(1.1); /* Slightly larger */
           }

           /* Flex container for prediction buttons */
           #prediction-options {
               display: flex;
               flex-wrap: wrap;
               justify-content: center;
           }

           /* Success message animation */
           [x-cloak] {
               display: none;
           }
       </style>
   </x-app-layout>
