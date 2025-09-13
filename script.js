document.addEventListener('DOMContentLoaded', function() {
    const gasProgress = document.getElementById('gas-progress');
    const gasValue = document.getElementById('gas-value');
    const gasLevel = 50; // Example gas level in percentage

    // Update the circular progress
    gasProgress.style.setProperty('--progress', `${gasLevel * 3.6}deg`);
    gasValue.textContent = `${gasLevel}%`;
});
