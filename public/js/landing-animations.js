document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Event data
    const events = [
        {
            category: 'SUMMER FEST 2024',
            title1: 'Electronic',
            title2: 'Paradise',
            date: 'August 15, 2024',
            venue: 'City Arena',
            price: '$89',
            color: 'blue',
            themeColor: '#3B82F6',
            gradient: 'from-blue-600 via-blue-500 to-cyan-500'   // replace this with image
        },
        {
            category: 'ROCK FESTIVAL',
            title1: 'Rock The',
            title2: 'Night',
            date: 'September 20, 2024',
            venue: 'Stadium Arena',
            price: '$125',
            color: 'red',
            themeColor: '#EF4444',
            gradient: 'from-red-600 via-red-500 to-orange-500' // replace this with image
        },
        {
            category: 'JAZZ EVENING',
            title1: 'Smooth Jazz',
            title2: 'Night',
            date: 'October 5, 2024',
            venue: 'Jazz Lounge',
            price: '$65',
            color: 'purple',
            themeColor: '#A855F7',
            gradient: 'from-purple-600 via-purple-500 to-pink-500' // replace this with image
        }
    ];

    let currentSlide = 0;

    // Hero Timeline - Professional entrance animations
    const heroTL = gsap.timeline({
        defaults: { ease: 'power2.out' }
    });

    heroTL
        .from('.event-badge', {
            duration: 0.6,
            y: -20,
            opacity: 0
        })
        .from('.title-line-1', {
            duration: 0.8,
            x: -60,
            opacity: 0
        }, '-=0.3')
        .from('.title-line-2', {
            duration: 0.8,
            x: -60,
            opacity: 0
        }, '-=0.6')
        .from('.event-details', {
            duration: 0.8,
            y: 30,
            opacity: 0
        }, '-=0.4')
        .from('.cta-button', {
            duration: 0.6,
            y: 20,
            opacity: 0,
            scale: 0.95
        }, '-=0.4')
        .from('.slider-controls', {
            duration: 0.6,
            y: 20,
            opacity: 0
        }, '-=0.4')
        .from('.poster-container', {
            duration: 1,
            x: 100,
            opacity: 0,
            scale: 0.9
        }, '-=1')
        .from('.poster-icon', {
            scale: 0,
            rotation: -180,
            duration: 0.8,
            ease: 'back.out(1.7)'
        }, '-=0.5')
        .from('.poster-title-1', {
            opacity: 0,
            y: 30,
            duration: 0.6
        }, '-=0.4')
        .from('.poster-title-2', {
            opacity: 0,
            y: 30,
            duration: 0.6
        }, '-=0.5')
        .from('.poster-details', {
            opacity: 0,
            y: 40,
            duration: 0.8
        }, '-=0.4');

    // Enhanced floating orb animations with position movement and color sync
    const orbs = document.querySelectorAll('.pulse-slow');
    const posterGlows = document.querySelectorAll('.poster-glow-1, .poster-glow-2');
    
    // Get the current theme color
    function getCurrentThemeColor() {
        return events[currentSlide].themeColor;
    }
    
    // Update orb colors smoothly
    function updateOrbColors(color) {
        orbs.forEach(orb => {
            gsap.to(orb, {
                backgroundColor: color,
                duration: 0.8,
                ease: 'power2.inOut'
            });
        });
        
        posterGlows.forEach(glow => {
            gsap.to(glow, {
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

    // Animate poster glow effects
    gsap.to('.poster-glow-1', {
        scale: 1.2,
        opacity: 0.6,
        duration: 3,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
    });

    gsap.to('.poster-glow-2', {
        scale: 1.3,
        opacity: 0.5,
        duration: 4,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: 1
    });

    // Continuous floating animation for poster icon
    gsap.to('.poster-icon', {
        y: -10,
        duration: 3,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
    });

    // Function to update slide
    function updateSlide(index) {
        const event = events[index];
        const tl = gsap.timeline();

        // Fade out current content
        tl.to(['.event-badge', '.event-title', '.event-details', '.cta-button'], {
            opacity: 0,
            y: -20,
            duration: 0.8,
            stagger: 0.05
        });

        tl.to('.poster-main', {
            opacity: 0,
            scale: 0.95,
            duration: 0.6
        }, '<');

        // Update content
        tl.call(() => {
            // Update left side content
            document.getElementById('event-category').textContent = event.category;
            document.querySelector('.title-line-1').textContent = event.title1;
            document.querySelector('.title-line-2').textContent = event.title2;
            document.getElementById('event-date').textContent = event.date;
            document.getElementById('event-venue').textContent = event.venue;
            document.getElementById('event-price').textContent = event.price;

            // Update poster content
            document.getElementById('poster-category').textContent = event.category;
            document.querySelector('.poster-title-1').textContent = event.title1.toUpperCase();
            document.querySelector('.poster-title-2').textContent = event.title2.toUpperCase();
            document.getElementById('poster-date').textContent = event.date;
            document.getElementById('poster-venue').textContent = event.venue;
            document.getElementById('poster-price').textContent = event.price;

            // Update colors and gradients
            const posterMain = document.querySelector('.poster-main');
            const posterDiv = posterMain.querySelector('div');
            
            // Remove old gradient classes
            posterDiv.classList.remove('from-blue-600', 'via-blue-500', 'to-cyan-500');
            posterDiv.classList.remove('from-red-600', 'via-red-500', 'to-orange-500');
            posterDiv.classList.remove('from-purple-600', 'via-purple-500', 'to-pink-500');
            
            // Add new gradient classes
            const gradientClasses = event.gradient.split(' ');
            gradientClasses.forEach(cls => posterDiv.classList.add(cls));

            // Update border colors
            posterMain.classList.remove('border-blue-500/30', 'border-red-500/30', 'border-purple-500/30');
            posterMain.classList.add(`border-${event.color}-500/30`);

            // Update dots
            document.querySelectorAll('.dot').forEach((dot, i) => {
                dot.classList.remove('bg-blue-400', 'bg-red-400', 'bg-purple-400', 'bg-white/30');
                if (i === index) {
                    dot.classList.add(`bg-${event.color}-400`);
                } else {
                    dot.classList.add('bg-white/30');
                }
            });

            // Update orb colors
            updateOrbColors(event.themeColor);
        });

        // Fade in new content
        tl.to(['.event-badge', '.event-title', '.event-details', '.cta-button'], {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.08,
            ease: 'power3.out'
        });

        tl.to('.poster-main', {
            opacity: 1,
            scale: 1,
            duration: 0.5,
            ease: 'power3.out'
        }, '<0.2');

        // Animate poster icon with bounce
        tl.fromTo('.poster-icon',
            { scale: 0.8, rotation: -90 },
            { scale: 1, rotation: 0, duration: 0.6, ease: 'back.out(1.7)' },
            '<0.3'
        );

        currentSlide = index;
    }

    // Event listeners for navigation
    document.querySelector('.slider-prev').addEventListener('click', () => {
        const newIndex = (currentSlide - 1 + events.length) % events.length;
        updateSlide(newIndex);
    });

    document.querySelector('.slider-next').addEventListener('click', () => {
        const newIndex = (currentSlide + 1) % events.length;
        updateSlide(newIndex);
    });

    document.querySelectorAll('.dot').forEach((dot, index) => {
        dot.addEventListener('click', () => {
            updateSlide(index);
        });
    });

    // Auto-play slider
    let autoPlayInterval;
    
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            const newIndex = (currentSlide + 1) % events.length;
            updateSlide(newIndex);
        }, 5000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Start auto-play
    startAutoPlay();

    // Stop auto-play on user interaction
    document.querySelector('.slider-prev').addEventListener('click', () => {
        stopAutoPlay();
        setTimeout(startAutoPlay, 10000);
    });

    document.querySelector('.slider-next').addEventListener('click', () => {
        stopAutoPlay();
        setTimeout(startAutoPlay, 10000);
    });

    document.querySelectorAll('.dot').forEach(dot => {
        dot.addEventListener('click', () => {
            stopAutoPlay();
            setTimeout(startAutoPlay, 10000);
        });
    });

    // Parallax effect on mouse move
    const poster = document.querySelector('.poster-container');
    
    document.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const { innerWidth, innerHeight } = window;
        
        const xPos = (clientX / innerWidth - 0.5) * 20;
        const yPos = (clientY / innerHeight - 0.5) * 20;
        
        gsap.to(poster, {
            x: xPos,
            y: yPos,
            duration: 0.5,
            ease: 'power2.out'
        });

        gsap.to('.poster-glow-1', {
            x: -xPos * 0.5,
            y: -yPos * 0.5,
            duration: 0.8,
            ease: 'power2.out'
        });

        gsap.to('.poster-glow-2', {
            x: xPos * 0.3,
            y: yPos * 0.3,
            duration: 1,
            ease: 'power2.out'
        });
    });

    // Section Header Animations
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