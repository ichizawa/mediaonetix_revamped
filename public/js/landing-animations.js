document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Hero Timeline - Refined, professional entrance
    const heroTL = gsap.timeline({
        defaults: { ease: 'power2.out' }
    });

    heroTL
        .from('.hero-badge', {
            duration: 0.6,
            y: -20,
            opacity: 0
        })
        .from('.hero-title', {
            duration: 1,
            y: 40,
            opacity: 0
        }, '-=0.3')
        .from('.hero-subtitle', {
            duration: 0.8,
            y: 20,
            opacity: 0
        }, '-=0.5')
        .from('.hero-visual', {
            duration: 0.8,
            y: 30,
            opacity: 0,
            scale: 0.95
        }, '-=0.4')
        .from('.hero-cta button', {
            duration: 0.6,
            y: 20,
            opacity: 0,
            stagger: 0.1
        }, '-=0.4')
        .from('.hero-stats > div', {
            duration: 0.8,
            y: 30,
            opacity: 0,
            stagger: 0.1
        }, '-=0.4');

    // Enhanced floating orb animations with position movement and color sync
    const orbs = document.querySelectorAll('.pulse-slow');
    const decorativeOrbs = document.querySelectorAll('.hero-visual .absolute[class*="bg-blue"]');
    
    // Get the current active slide to sync orb colors
    function getCurrentThemeColor() {
        const activeSlide = document.querySelector('.event-slide.active');
        if (activeSlide) {
            return activeSlide.dataset.themeColor || '#3B82F6';
        }
        return '#3B82F6';
    }
    
    // Update orb colors smoothly
    function updateOrbColors(color) {
        const allOrbs = [...orbs, ...decorativeOrbs];
        allOrbs.forEach(orb => {
            gsap.to(orb, {
                backgroundColor: color,
                duration: 0.8,
                ease: 'power2.inOut'
            });
        });
    }
    
    // Floating movement for main orbs
    orbs.forEach((orb, index) => {
        gsap.to(orb, {
            x: index % 2 === 0 ? 50 : -40,
            y: index % 2 === 0 ? 40 : -50,
            duration: index % 2 === 0 ? 20 : 18,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
        
        gsap.to(orb, {
            opacity: 0.4,
            duration: 4,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    });
    
    // Listen for slide changes and update orbs
    const sliderContainer = document.querySelector('.event-slider-container');
    if (sliderContainer) {
        const observer = new MutationObserver(() => {
            const newColor = getCurrentThemeColor();
            updateOrbColors(newColor);
        });
        
        observer.observe(sliderContainer, {
            attributes: true,
            subtree: true,
            attributeFilter: ['class']
        });
    }

    // Section Header
    gsap.from('.section-header > *', {
        scrollTrigger: {
            trigger: '.section-header',
            start: 'top 80%',
            toggleActions: 'play none none none'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.15,
        ease: 'power2.out'
    });

    // Feature Cards - Set initial state first
    gsap.set('.feature-grid .feature-card', {
        opacity: 1,
        y: 0
    });

    gsap.from('.feature-grid .feature-card', {
        scrollTrigger: {
            trigger: '.feature-grid',
            start: 'top 85%',
            toggleActions: 'play none none none'
        },
        duration: 0.6,
        y: 40,
        opacity: 0,
        stagger: 0.08,
        ease: 'power2.out'
    });

    // CTA Section
    const ctaTL = gsap.timeline({
        scrollTrigger: {
            trigger: '.cta-section',
            start: 'top 75%',
            toggleActions: 'play none none none'
        },
        defaults: { ease: 'power2.out' }
    });

    ctaTL
        .from('.cta-badge', {
            duration: 0.5,
            y: -15,
            opacity: 0
        })
        .from('.cta-title', {
            duration: 0.8,
            y: 30,
            opacity: 0
        }, '-=0.2')
        .from('.cta-subtitle', {
            duration: 0.7,
            y: 20,
            opacity: 0
        }, '-=0.4')
        .from('.cta-button', {
            duration: 0.6,
            y: 20,
            opacity: 0
        }, '-=0.3')
        .from('.cta-note', {
            duration: 0.5,
            y: 15,
            opacity: 0
        }, '-=0.2');
});