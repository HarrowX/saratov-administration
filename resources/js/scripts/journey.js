
function startJourney() {
    // Scroll to attractions section
    const attractionsSection = document.getElementById('attractions');
    if (attractionsSection) {
        attractionsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Show notification
    showNotification('Добро пожаловать в путешествие по Саратову!', 'success');
}

window.startJourney = startJourney;