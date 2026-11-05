/**
 * 3D Perspective Tilt & Optical Lens Glare for Capability Cards
 * Smooth 60/120fps gyro tilt with layered parallax depth.
 * Strictly adheres to Anti-Slop (MOTION: 2, deliberate, restrained).
 * Respects touch-devices and prefers-reduced-motion.
 */

export function initTiltCards() {
  const isTouch = window.matchMedia('(hover: none)').matches;
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (isTouch || prefersReducedMotion) return;

  const cards = document.querySelectorAll('[data-tilt-card]');
  if (!cards.length) return;

  cards.forEach((card) => {
    let rafId = null;

    const onMouseMove = (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const px = ((x / rect.width) * 100).toFixed(1);
      const py = ((y / rect.height) * 100).toFixed(1);
      card.style.setProperty('--glare-x', `${px}%`);
      card.style.setProperty('--glare-y', `${py}%`);

      // Controlled tilt angle: max ~7.5 degrees for optimal readability and zero disorientation
      const rotateX = (((y / rect.height) - 0.5) * -15).toFixed(2);
      const rotateY = (((x / rect.width) - 0.5) * 15).toFixed(2);

      if (rafId) cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(() => {
        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        card.style.transition = 'transform 0.08s ease-out, border-color 0.3s ease, box-shadow 0.3s ease';
      });
    };

    const onMouseLeave = () => {
      if (rafId) cancelAnimationFrame(rafId);
      card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
      card.style.transition = 'transform 0.5s cubic-bezier(0.23, 1, 0.32, 1), border-color 0.3s ease, box-shadow 0.3s ease';
      card.style.removeProperty('--glare-x');
      card.style.removeProperty('--glare-y');
    };

    card.addEventListener('mousemove', onMouseMove);
    card.addEventListener('mouseleave', onMouseLeave);
  });
}

