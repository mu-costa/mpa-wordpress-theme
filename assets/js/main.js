document.addEventListener('DOMContentLoaded', function() {
    // Slider functionality
    const slider = {
        container: document.querySelector('.slider-container'),
        slides: document.querySelectorAll('.slide'),
        prevButton: document.querySelector('.slider-nav.prev'),
        nextButton: document.querySelector('.slider-nav.next'),
        currentSlide: 0,
        slideInterval: null,
        
        init: function() {
            if (!this.slides.length) return;
            
            // Set up initial state
            this.showSlide(0);
            this.setupEventListeners();
            this.startAutoPlay();
        },
        
        showSlide: function(index) {
            // Hide all slides
            this.slides.forEach(slide => {
                slide.style.display = 'none';
            });
            
            // Show the current slide
            this.slides[index].style.display = 'block';
            this.currentSlide = index;
        },
        
        nextSlide: function() {
            const next = (this.currentSlide + 1) % this.slides.length;
            this.showSlide(next);
        },
        
        prevSlide: function() {
            const prev = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.showSlide(prev);
        },
        
        startAutoPlay: function() {
            this.slideInterval = setInterval(() => {
                this.nextSlide();
            }, 5000); // Change slide every 5 seconds
        },
        
        stopAutoPlay: function() {
            if (this.slideInterval) {
                clearInterval(this.slideInterval);
                this.slideInterval = null;
            }
        },
        
        setupEventListeners: function() {
            // Navigation buttons
            this.prevButton?.addEventListener('click', () => {
                this.prevSlide();
                this.stopAutoPlay();
            });
            
            this.nextButton?.addEventListener('click', () => {
                this.nextSlide();
                this.stopAutoPlay();
            });
            
            // Pause on hover
            this.container?.addEventListener('mouseenter', () => {
                this.stopAutoPlay();
            });
            
            this.container?.addEventListener('mouseleave', () => {
                this.startAutoPlay();
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    this.prevSlide();
                    this.stopAutoPlay();
                } else if (e.key === 'ArrowRight') {
                    this.nextSlide();
                    this.stopAutoPlay();
                }
            });
        }
    };
    
    // Initialize slider if it exists
    if (document.querySelector('.slider-container')) {
        slider.init();
    }
    
    // Mobile Menu Toggle
    const mobileMenu = {
        toggle: document.querySelector('.menu-toggle'),
        menu: document.querySelector('.main-navigation .menu'),
        
        init: function() {
            if (!this.toggle || !this.menu) return;
            
            this.toggle.addEventListener('click', () => {
                this.menu.classList.toggle('active');
                this.toggle.setAttribute('aria-expanded',
                    this.toggle.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
                );
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!this.menu.contains(e.target) && !this.toggle.contains(e.target)) {
                    this.menu.classList.remove('active');
                    this.toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    };
    
    mobileMenu.init();
    
    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Image Error Handler
    function handleImageError(img) {
        img.onerror = null; // Prevent infinite loop
        img.src = '/wp-content/themes/mpa-theme/assets/images/placeholder.jpg';
        img.classList.add('image-error');
    }
    
    // Apply error handler to all images
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', () => handleImageError(img));
    });
    
    // Social Share Buttons
    const socialShare = {
        init: function() {
            document.querySelectorAll('.social-share a').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const url = link.href;
                    window.open(url, 'share-dialog', 'width=600,height=400');
                });
            });
        }
    };
    
    socialShare.init();
});

// Add a global error handler
window.onerror = function(msg, url, lineNo, columnNo, error) {
    console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
    return false;
};
