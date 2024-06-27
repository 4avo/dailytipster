document.addEventListener('DOMContentLoaded', function () {
    const buyButtons = document.querySelectorAll('.buy-item');
    const userCredits = parseInt(document.getElementById('user-credits').innerText);
    const modal = document.getElementById('purchase-feedback');
    const feedbackText = document.getElementById('feedback-text');
    const closeBtn = document.getElementById('close-feedback');

    buyButtons.forEach(button => {
        button.addEventListener('click', function () {
            const itemPrice = parseInt(this.getAttribute('data-price'));
            const itemName = this.getAttribute('data-item');

            if (userCredits < itemPrice) {
                showFeedbackModal(`Insufficient credits. You need ${itemPrice - userCredits} more credits to buy ${itemName}.`);
            } else {
                // Simulate purchase process (adjust as per actual implementation)
                // Deduct credits (simulated)
                const remainingCredits = userCredits - itemPrice;
                document.getElementById('user-credits').innerText = remainingCredits;
                
                // Show success feedback
                showFeedbackModal(`Successfully purchased ${itemName} for ${itemPrice} credits.`);
            }
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    function showFeedbackModal(message) {
        feedbackText.innerText = message;
        modal.classList.remove('hidden');
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const leaguesDisplay = document.getElementById('leagues-display');
    const leagueLogo = document.getElementById('league-logo');
    const leagueName = document.getElementById('league-name');
    const leaguesMenu = document.getElementById('leagues-menu');
    const customDropdownItems = document.querySelectorAll('.custom-dropdown-item');
    const homeTeamDropdown = document.getElementById('home-team');
    const awayTeamDropdown = document.getElementById('away-team');
    const predictionButtons = document.querySelectorAll('.prediction-button');
    const predictionInput = document.getElementById('prediction-input');

    leaguesDisplay.addEventListener('click', function () {
        leaguesMenu.classList.toggle('hidden');
    });

    customDropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            const logo = item.getAttribute('data-logo');
            const name = item.getAttribute('data-name');
            const teams = JSON.parse(item.getAttribute('data-teams'));

            leagueLogo.src = logo;
            leagueLogo.alt = `${name} logo`;
            leagueLogo.classList.remove('hidden');
            
            leagueName.textContent = name;
            
            leaguesDisplay.dataset.value = item.dataset.value;
            leaguesMenu.classList.add('hidden');

            homeTeamDropdown.innerHTML = '<option value="" disabled selected>Select Home Team</option>';
            awayTeamDropdown.innerHTML = '<option value="" disabled selected>Select Away Team</option>';
            teams.forEach(team => {
                const option = document.createElement('option');
                option.value = team;
                option.textContent = team;
                homeTeamDropdown.appendChild(option.cloneNode(true));
                awayTeamDropdown.appendChild(option);
            });

            leaguesDisplay.dispatchEvent(new Event('change'));
        });
    });

    document.addEventListener('click', function (event) {
        if (!leaguesDisplay.contains(event.target) && !leaguesMenu.contains(event.target)) {
            leaguesMenu.classList.add('hidden');
        }
    });

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

    predictionButtons.forEach(button => {
        button.addEventListener('click', function () {
            predictionButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            predictionInput.value = this.getAttribute('data-value');
        });
    });
});