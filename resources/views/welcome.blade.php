<x-app-layout>
    <div class="min-h-screen bg-black text-white py-12 px-6 flex items-start justify-start">
        <div class="w-full max-w-lg bg-black rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold mb-8">Make a prediction</h1>

            <!-- Custom Leagues Dropdown -->
            <div>
                <label for="leagues" class="block text-lg font-medium mb-2">Leagues:</label>
                <div class="custom-dropdown relative">
                    <div class="relative flex items-center">
                        <div id="leagues-display" class="flex items-center w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                            <img id="league-logo" src="" alt="" class="w-6 h-6 mr-2 hidden">
                            <span id="league-name" class="flex-1">Select League</span>
                        </div>
                        <span id="clear-selection" class="ml-2 text-xl cursor-pointer absolute right-3 top-1/2 transform -translate-y-1/2 hidden">&times;</span>
                    </div>
                    <div id="leagues-menu" class="custom-dropdown-menu hidden absolute w-full bg-black text-white border border-white rounded-lg mt-1">
                        <ul id="leagues-list">
                            @foreach($leagues as $league)
                                <li class="custom-dropdown-item p-2 flex items-center cursor-pointer" data-value="{{ $league['id'] }}" data-logo="{{ $league['logo'] }}" data-name="{{ $league['name'] }}">
                                    <img src="{{ $league['logo'] }}" alt="{{ $league['name'] }} logo" class="w-6 h-6 mr-2">
                                    {{ $league['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Other content of the page -->
            <form class="space-y-6 mt-6">
                <div>
                    <label for="home-team" class="block text-lg font-medium mb-2">Home Team:</label>
                    <select id="home-team" name="home-team" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="" disabled selected>Select Home Team</option>
                    </select>
                </div>

                <div>
                    <label for="away-team" class="block text-lg font-medium mb-2">Away Team:</label>
                    <select id="away-team" name="away-team" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="" disabled selected>Select Away Team</option>
                    </select>
                </div>

                <div>
                    <label for="prediction" class="block text-lg font-medium mb-2">Prediction:</label>
                    <input type="text" id="prediction" name="prediction" class="w-full bg-black text-white border border-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white" placeholder="Enter your prediction">
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-3 rounded-lg transition duration-300">Submit Prediction</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const leaguesDisplay = document.getElementById('leagues-display');
            const leagueLogo = document.getElementById('league-logo');
            const leagueName = document.getElementById('league-name');
            const leaguesMenu = document.getElementById('leagues-menu');
            const customDropdownItems = document.querySelectorAll('.custom-dropdown-item');
            const clearSelection = document.getElementById('clear-selection');

            leaguesDisplay.addEventListener('click', function () {
                leaguesMenu.classList.toggle('hidden');
            });

            customDropdownItems.forEach(item => {
                item.addEventListener('click', function () {
                    const logo = item.getAttribute('data-logo');
                    const name = item.getAttribute('data-name');
                    leagueLogo.src = logo;
                    leagueLogo.alt = `${name} logo`;
                    leagueLogo.classList.remove('hidden');
                    leagueName.textContent = name;
                    leaguesDisplay.dataset.value = item.dataset.value;
                    clearSelection.classList.remove('hidden');
                    leaguesMenu.classList.add('hidden');

                    // Trigger change event for further processing if needed
                    leaguesDisplay.dispatchEvent(new Event('change'));
                });
            });

            document.addEventListener('click', function (event) {
                if (!leaguesDisplay.contains(event.target) && !leaguesMenu.contains(event.target)) {
                    leaguesMenu.classList.add('hidden');
                }
            });

            leaguesDisplay.addEventListener('change', function () {
                const leagueId = leaguesDisplay.dataset.value;
                const homeTeamDropdown = document.getElementById('home-team');
                const awayTeamDropdown = document.getElementById('away-team');

                homeTeamDropdown.innerHTML = '<option value="" disabled selected>Select Home Team</option>';
                awayTeamDropdown.innerHTML = '<option value="" disabled selected>Select Away Team</option>';

                if (leagueId) {
                    fetch(`/api/teams?league_id=${leagueId}`)
                        .then(response => response.json())
                        .then(data => {
                            const teams = data.teams;
                            teams.forEach(team => {
                                const option = document.createElement('option');
                                option.value = team.id;
                                option.textContent = team.name;
                                homeTeamDropdown.appendChild(option.cloneNode(true));
                                awayTeamDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching teams:', error));
                }
            });

            clearSelection.addEventListener('click', function () {
                leagueLogo.classList.add('hidden');
                leagueName.textContent = 'Select League';
                leaguesDisplay.removeAttribute('data-value');
                clearSelection.classList.add('hidden');

                // Trigger change event for further processing if needed
                leaguesDisplay.dispatchEvent(new Event('change'));
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
    </style>
</x-app-layout>
