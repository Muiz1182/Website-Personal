/**
 * TechText - Inspired by React Bits TechText / Decrypted Text Animation
 * Cycles through random tech/cyber glyphs before revealing the resolved target text.
 * Triggers automatically on load and re-scrambles smoothly on mouse hover.
 */

const GLYPHS = '01_>#*+-%~X[]{}?/!&@$ABCDEF0123456789';

export function createTechText(element, options = {}) {
  if (!element) return null;

  const targetText = options.text || element.dataset.techText || element.textContent.trim() || 'MMA PRODUCTION';
  const speed = options.speed || 38; // ms per tick
  const maxIterations = options.maxIterations || 16;
  const characterSet = options.characterSet || GLYPHS;
  
  let currentIteration = 0;
  let interval = null;
  let isRunning = false;

  const getRandomChar = () => characterSet[Math.floor(Math.random() * characterSet.length)];

  function scramble() {
    if (isRunning) clearInterval(interval);
    isRunning = true;
    currentIteration = 0;

    const length = targetText.length;

    interval = setInterval(() => {
      currentIteration++;

      const progress = currentIteration / maxIterations;
      const revealedLength = Math.floor(progress * length);

      let output = '';
      for (let i = 0; i < length; i++) {
        const char = targetText[i];
        if (char === ' ' || char === '\n') {
          output += char;
        } else if (i < revealedLength) {
          output += `<span class="text-white">${char}</span>`;
        } else if (i === revealedLength) {
          output += `<span class="text-[#FF5722] animate-pulse">${getRandomChar()}</span>`;
        } else {
          output += `<span class="text-neutral-500">${getRandomChar()}</span>`;
        }
      }

      element.innerHTML = output;

      if (currentIteration >= maxIterations) {
        clearInterval(interval);
        isRunning = false;
        // Final clean output
        element.innerHTML = targetText
          .split('')
          .map((c, idx) => {
            if (c === ' ' || c === '\n') return c;
            // Highlight the brand accent letters or clean display
            return `<span class="text-white transition-colors duration-200">${c}</span>`;
          })
          .join('');
      }
    }, speed);
  }

  // Trigger on hover
  element.addEventListener('mouseenter', () => {
    if (!isRunning) scramble();
  });

  // Initial trigger
  scramble();

  return {
    scramble,
    destroy() {
      if (interval) clearInterval(interval);
      element.removeEventListener('mouseenter', scramble);
    }
  };
}

export function initTechTexts() {
  const elements = document.querySelectorAll('[data-tech-text]');
  elements.forEach(el => {
    if (el._techTextInstance) return;
    el._techTextInstance = createTechText(el, {
      text: el.dataset.techText,
      speed: parseInt(el.dataset.speed || '35', 10),
      maxIterations: parseInt(el.dataset.iterations || '18', 10)
    });
  });
}
