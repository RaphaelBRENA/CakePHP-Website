    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const voiceSearchBtn = document.getElementById('voiceSearchBtn');

    if (window.SpeechRecognition || window.webkitSpeechRecognition) {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();
    recognition.lang = 'fr-FR';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    recognition.onresult = function(event) {
    const speechResult = event.results[0][0].transcript;
    searchInput.value = speechResult;
    searchInput.form.submit();
};

    recognition.onspeechend = function() {
    recognition.stop();
};

    recognition.onerror = function(event) {
    console.error('Speech recognition error detected: ' + event.error);
};

    voiceSearchBtn.addEventListener('click', function() {
    recognition.start();
});
} else {
    console.error('Speech recognition not supported.');
}
});
