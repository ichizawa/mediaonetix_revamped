//LOGIN ANIMATIONS
// Initialize GSAP animations
gsap.registerPlugin();

// Animate login form elements on load
gsap.from('.login-header', {
    opacity: 0,
    y: -30,
    duration: 0.8,
    ease: 'power3.out'
});

gsap.from('.login-card', {
    opacity: 0,
    y: 30,
    duration: 0.8,
    delay: 0.2,
    ease: 'power3.out'
});

gsap.from('.form-group', {
    opacity: 0,
    x: -20,
    duration: 0.6,
    stagger: 0.1,
    delay: 0.4,
    ease: 'power2.out'
});