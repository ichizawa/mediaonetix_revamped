document.addEventListener('DOMContentLoaded', async function () {
    gsap.registerPlugin(ScrollTrigger);

    // Event data
    // const events = [
    //     {
    //         category: 'SUMMER FEST 2024',
    //         title1: 'Electronic',
    //         title2: 'Paradise',
    //         date: 'August 15, 2024',
    //         venue: 'City Arena',
    //         price: '$89',
    //         color: 'blue',
    //         themeColor: '#3B82F6',
    //         gradient: 'from-blue-600 via-blue-500 to-cyan-500'   // replace this with image
    //     },
    //     {
    //         category: 'ROCK FESTIVAL',
    //         title1: 'Rock The',
    //         title2: 'Night',
    //         date: 'September 20, 2024',
    //         venue: 'Stadium Arena',
    //         price: '$125',
    //         color: 'red',
    //         themeColor: '#EF4444',
    //         gradient: 'from-red-600 via-red-500 to-orange-500' // replace this with image
    //     },
    //     {
    //         category: 'JAZZ EVENING',
    //         title1: 'Smooth Jazz',
    //         title2: 'Night',
    //         date: 'October 5, 2024',
    //         venue: 'Jazz Lounge',
    //         price: '$65',
    //         color: 'purple',
    //         themeColor: '#A855F7',
    //         gradient: 'from-purple-600 via-purple-500 to-pink-500' // replace this with image
    //     }
    // ];
    let events = [];

    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    const res = await fetch('/show-case/events', {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token
        }
    });

    const response = await res.json();

    console.log("response from api: ", response);

    events = response.data.map((event) => {
        // Format date
        const eventDate = new Date(event.event_date);
        const formattedDate = eventDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Split title
        const nameParts = event.event_name.split(' ');
        const title1 = nameParts[0] || '';
        const title2 = nameParts.length > 1 ? nameParts[nameParts.length - 1] : '';

        let price = 'N/A';
        if (event.tickets && event.tickets.length > 0) {
            const prices = event.tickets.map(t => t.price);
            const minPrice = Math.min(...prices);
            price = `₱${minPrice}`;
        }

        return {
            category: event.category,
            title1: title1,
            title2: title2,
            date: formattedDate,
            venue: event.event_venue,
            price: price,
            color: event.status_label.color,
            themeColor: '#3B82F6',
            imageUrl: event.event_image_url
        }
    });

    if (events.length > 0) {
        const first = events[0];
        document.getElementById('event-category').textContent = first.category;
        document.querySelector('.title-line-1').textContent = first.title1;
        document.querySelector('.title-line-2').textContent = first.title2;
        document.getElementById('event-date').textContent = first.date;
        document.getElementById('event-venue').textContent = first.venue;
        document.getElementById('event-price').textContent = first.price;

        document.getElementById('poster-category').textContent = first.category;
        document.querySelector('.poster-title-1').textContent = first.title1.toUpperCase();
        document.querySelector('.poster-title-2').textContent = first.title2.toUpperCase();
        document.getElementById('poster-date').textContent = first.date;
        document.getElementById('poster-venue').textContent = first.venue;
        document.getElementById('poster-price').textContent = first.price;

        // Set poster image
        const posterBg = document.getElementById('poster-bg');
        if (posterBg && first.imageUrl) {
            posterBg.style.backgroundImage = `url('${first.imageUrl}')`;
            posterBg.style.backgroundSize = 'cover';
            posterBg.style.backgroundPosition = 'center';
            posterBg.style.backgroundColor = 'transparent';

            const overlay = document.createElement('div');
            overlay.className = 'poster-img-overlay absolute inset-0';
            overlay.style.cssText = 'background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.65)); z-index: 0;';
            posterBg.insertBefore(overlay, posterBg.firstChild);
        }
    }

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
            const posterBg = document.getElementById('poster-bg');
            if (posterBg) {
                if (event.imageUrl) {
                    posterBg.style.backgroundImage = `url('${event.imageUrl}')`;
                    posterBg.style.backgroundSize = 'cover';
                    posterBg.style.backgroundPosition = 'center';
                    posterBg.style.backgroundColor = 'transparent';

                    // Add dark overlay for text readability (only once)
                    if (!posterBg.querySelector('.poster-img-overlay')) {
                        const overlay = document.createElement('div');
                        overlay.className = 'poster-img-overlay absolute inset-0';
                        overlay.style.cssText = 'background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.65)); z-index: 0;';
                        posterBg.insertBefore(overlay, posterBg.firstChild);
                    }
                } else {
                    posterBg.style.backgroundImage = '';
                    posterBg.style.background = 'linear-gradient(135deg, #1e40af, #3b82f6, #06b6d4)';
                    const overlay = posterBg.querySelector('.poster-img-overlay');
                    if (overlay) overlay.remove();
                }
            }

            // Update dots
            document.querySelectorAll('.dot').forEach((dot, i) => {
                dot.classList.remove('bg-blue-400', 'bg-red-400', 'bg-purple-400', 'bg-white/30');
                dot.classList.add(i === index ? 'bg-blue-400' : 'bg-white/30');
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