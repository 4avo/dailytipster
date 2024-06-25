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
