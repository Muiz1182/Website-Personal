import './bootstrap';
import { createLanyard, initLanyards } from './lanyard';
import { createTechText, initTechTexts } from './tech-text';

// Expose on window for easy access / Alpine interaction if needed
window.createLanyard = createLanyard;
window.createTechText = createTechText;

document.addEventListener('DOMContentLoaded', () => {
    initLanyards();
    initTechTexts();
});
