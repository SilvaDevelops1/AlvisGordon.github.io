// Purpose: This file is used to handle the button clicks on the home page.
const linkedinButton = document.getElementById('linkedin-button');
const githubButton = document.getElementById('github-button');
const twitterButton = document.getElementById('twitter-button');
const youtubeButton = document.getElementById('youtube-button');

linkedinButton.addEventListener('click', () => {
    window.open("https://www.linkedin.com/in/alvis-gordon-7a826731a/");
});

githubButton.addEventListener('click', () => {
    window.open("https://github.com/SilvaDevelops1");
});

youtubeButton.addEventListener('click', () => {
    window.open("https://www.youtube.com/@SilvaDevelps");
});
