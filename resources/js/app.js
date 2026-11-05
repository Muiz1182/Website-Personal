import './bootstrap';
import { createLanyard, initLanyards } from './lanyard';
import { createTechText, initTechTexts } from './tech-text';
import { initTiltCards } from './card-tilt';

// Expose on window for easy access / Alpine interaction if needed
window.createLanyard = createLanyard;
window.createTechText = createTechText;
window.initTiltCards = initTiltCards;

document.addEventListener('DOMContentLoaded', () => {
    initLanyards();
    initTechTexts();
    initTiltCards();
});
