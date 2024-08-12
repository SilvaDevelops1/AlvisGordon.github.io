const typedTextElement = document.getElementById("typed-text");
const phrases = ["Web Developer ", "ICT Student ", "YouTuber & Streamer ", "Script Writer ", "Discord Bot Developer "];
let currentPhraseIndex = 0;
let currentCharIndex = 0;
let isDeleting = false;
let speed = 100; // Speed for typing and deleting

function type() {
    const currentPhrase = phrases[currentPhraseIndex];
    let displayText = currentPhrase.slice(0, currentCharIndex);

    typedTextElement.textContent = displayText;

    if (isDeleting) {
        currentCharIndex--;
        speed = 50; // Speed while deleting
    } else {
        currentCharIndex++;
        speed = 100; // Speed while typing
    }

    if (!isDeleting && currentCharIndex === currentPhrase.length) {
        speed = 2000; // Pause at end of the phrase
        isDeleting = true;
    } else if (isDeleting && currentCharIndex === 0) {
        isDeleting = false;
        currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length;
        speed = 1000; // Pause before typing new phrase
    }

    setTimeout(type, speed);
}

type();