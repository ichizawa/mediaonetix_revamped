/**
 * Event Ticket Slider Component
 * Ready for dynamic event data integration
 */

class EventTicketSlider {
    constructor(containerSelector) {
        this.container = document.querySelector(containerSelector);
        this.slides = [];
        this.currentIndex = 0;
        this.autoplayInterval = null;
        this.autoplayDelay = 5000; // 5 seconds

        if (this.container) {
            this.init();
        }
    }

    init() {
        this.slides = Array.from(this.container.querySelectorAll('.event-slide'));

        // Only initialize slider if there are multiple slides
        if (this.slides.length > 1) {
            this.setupControls();
            this.startAutoplay();
        }
    }

    setupControls() {
        const controls = this.container.querySelector('.slider-controls');
        if (controls) {
            controls.classList.remove('hidden');
        }

        // Previous button
        const prevBtn = this.container.querySelector('.slider-prev');
        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.prev());
        }

        // Next button
        const nextBtn = this.container.querySelector('.slider-next');
        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.next());
        }

        // Pause autoplay on hover
        this.container.addEventListener('mouseenter', () => this.stopAutoplay());
        this.container.addEventListener('mouseleave', () => this.startAutoplay());
    }

    goToSlide(index) {
        // Remove active class from current slide
        this.slides[this.currentIndex].classList.remove('active');

        // Update index
        this.currentIndex = index;

        // Add active class to new slide
        this.slides[this.currentIndex].classList.add('active');

        // Update dots
        this.updateDots();
    }

    next() {
        const nextIndex = (this.currentIndex + 1) % this.slides.length;
        this.goToSlide(nextIndex);
    }

    prev() {
        const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        this.goToSlide(prevIndex);
    }

    updateDots() {
        const dots = this.container.querySelectorAll('.slider-dots span');
        dots.forEach((dot, index) => {
            if (index === this.currentIndex) {
                dot.classList.remove('bg-white/30');
                dot.classList.add('bg-blue-400');
            } else {
                dot.classList.remove('bg-blue-400');
                dot.classList.add('bg-white/30');
            }
        });
    }

    startAutoplay() {
        if (this.slides.length <= 1) return;

        this.stopAutoplay();
        this.autoplayInterval = setInterval(() => {
            this.next();
        }, this.autoplayDelay);
    }

    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    }

    // Method to dynamically add events (for future use)
    addEvent(eventData) {
        const slideHTML = this.createEventSlide(eventData);
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = slideHTML;
        const newSlide = tempDiv.firstElementChild;

        this.container.querySelector('.event-slider-container').appendChild(newSlide);
        this.slides.push(newSlide);

        // Re-initialize if this is the second slide
        if (this.slides.length === 2) {
            this.setupControls();
            this.startAutoplay();
        }

        this.updateDots();
    }

    createEventSlide(event) {
        return `
            <div class="event-slide floating">
                <div class="ticket-shape relative bg-gradient-to-br from-blue-600/20 to-blue-400/10 backdrop-blur-xl border border-blue-500/30 p-8 glow-effect">
                    <div class="space-y-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-sm text-gray-400 mb-1">${event.category || 'EVENT'}</div>
                                <div class="text-2xl font-bold text-white">${event.title}</div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                                ${event.icon || this.getDefaultIcon()}
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-700 pt-6 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Date</span>
                                <span class="font-semibold text-white">${event.date}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Location</span>
                                <span class="font-semibold text-white">${event.location}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Price</span>
                                <span class="text-2xl font-bold text-blue-400">$${event.price}</span>
                            </div>
                        </div>

                        <button class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all text-white">
                            Get Tickets
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    getDefaultIcon() {
        return `
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
            </svg>
        `;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const eventSlider = new EventTicketSlider('.event-slider-container');

    // Example: Add events dynamically in the future
    // window.eventSlider = eventSlider; // Make it globally accessible if needed

    eventSlider.addEvent({
        category: 'MUSIC FESTIVAL',
        title: 'Rock The Night',
        date: 'Sep 20, 2024',
        location: 'Stadium Arena',
        price: 125,
        icon: '<svg>...</svg>' // optional custom icon
    });

});
