<nav id="navbar" class="absolute top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="navbar-blur bg-transparent border-b border-transparent transition-all duration-500">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex items-center justify-between h-16 sm:h-20 transition-all duration-500">
                
                <!-- Logo -->
                <a href="#" class="flex items-center gap-2 sm:gap-3 group">
                    <div class="relative">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <div class="absolute -inset-1 bg-blue-500 rounded-lg blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    </div>
                    <span class="text-xl sm:text-2xl font-black text-white">
                        Mediaone<span class="gradient-text">Tix</span>
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="#events" class="px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-300 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                        Events
                    </a>
                    <a href="#features" class="px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-300 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                        Features
                    </a>
                    <a href="#pricing" class="px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-300 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                        Pricing
                    </a>
                    <a href="#contact" class="px-3 lg:px-4 py-2 text-sm lg:text-base text-gray-300 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                        Contact
                    </a>
                </div>

                <!-- Desktop CTA Buttons -->
                <div class="hidden md:flex items-center gap-3 lg:gap-4">
                    <a href="#signin" class="px-4 lg:px-5 py-2 lg:py-2.5 text-sm lg:text-base text-white hover:text-blue-400 transition-colors font-medium">
                        Sign In
                    </a>
                    <a href="#signup" class="group px-4 lg:px-6 py-2 lg:py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg font-bold text-sm lg:text-base shadow-lg hover:shadow-blue-500/50 transition-all hover:scale-105 inline-flex items-center gap-2 text-white">
                        Get Started
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 rounded-lg hover:bg-white/5 transition-colors group">
                    <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu md:hidden">
                <div class="py-4 space-y-1 border-t border-white/5">
                    <a href="#events" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 transition-colors rounded-lg">
                        Events
                    </a>
                    <a href="#features" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 transition-colors rounded-lg">
                        Features
                    </a>
                    <a href="#pricing" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 transition-colors rounded-lg">
                        Pricing
                    </a>
                    <a href="#contact" class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 transition-colors rounded-lg">
                        Contact
                    </a>
                    <div class="pt-4 space-y-3 border-t border-white/5">
                        <a href="#signin" class="block px-4 py-3 text-center text-white hover:text-blue-400 transition-colors font-medium">
                            Sign In
                        </a>
                        <a href="#signup" class="block px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg font-bold text-center shadow-lg text-white">
                            Get Started →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Initial state - navbar scrolls with page and is transparent */
    #navbar {
        position: absolute;
    }

    #navbar .navbar-blur {
        background: transparent;
        border-bottom: 1px solid transparent;
    }

    /* Scrolled state - navbar becomes fixed with background */
    #navbar.navbar-fixed {
        position: fixed;
        animation: slideDown 0.5s ease-out;
    }

    /* Enhanced background when fixed */
    #navbar.navbar-fixed .navbar-blur {
        background: rgba(12, 18, 34, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(59, 130, 246, 0.2);
        box-shadow: 0 10px 40px rgba(59, 130, 246, 0.1);
    }

    /* Slightly smaller navbar when fixed */
    #navbar.navbar-fixed .flex {
        height: 4rem; /* h-16 */
    }

    @media (min-width: 640px) {
        #navbar.navbar-fixed .flex {
            height: 4.5rem; /* Between h-16 and h-20 */
        }
    }

    /* Slide down animation */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Mobile menu styles */
    .mobile-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .mobile-menu.active {
        max-height: 500px;
    }

    /* Mobile menu background when open */
    .mobile-menu.active {
        background: rgba(12, 18, 34, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 0 0 1rem 1rem;
    }

    /* Hamburger animation */
    #mobile-menu-btn.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translateY(8px);
    }

    #mobile-menu-btn.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }

    #mobile-menu-btn.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translateY(-8px);
    }

    .gradient-text {
        background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    // Scroll threshold - when to make navbar fixed
    const scrollThreshold = 100;
    
    // Handle scroll event
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > scrollThreshold) {
            navbar.classList.add('navbar-fixed');
        } else {
            navbar.classList.remove('navbar-fixed');
        }
        
        lastScroll = currentScroll;
    });
    
    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenuBtn.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });
    
    // Close mobile menu when clicking on links
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenuBtn.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!navbar.contains(e.target)) {
            mobileMenuBtn.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });
});
</script>