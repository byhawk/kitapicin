/* ====================================
   MAVI GÜNEŞ SAHAF - ANA JAVASCRIPT
   Modern ve performant JavaScript kodu
   ===================================== */

// DOM yüklendiğinde çalışacak ana fonksiyon
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // === GLOBAL DEĞİŞKENLER ===
    const body = document.body;
    const navbar = document.getElementById('navbar');
    const preloader = document.getElementById('preloader');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    
    // === PRELOADER ===
    function hidePreloader() {
        if (preloader) {
            // 2 saniye sonra preloader'ı gizle
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
                
                // Tam olarak kaybolmasını bekle
                setTimeout(() => {
                    preloader.style.display = 'none';
                    body.classList.add('loaded');
                }, 500);
            }, 2000);
        }
    }

    // === FLOATING BACKGROUND ELEMENTS ===
    function createFloatingElements() {
        const floatingBg = document.querySelector('.floating-bg');
        if (!floatingBg) return;

        const elements = ['📚', '📖', '📙', '📗', '📘', '📕', '📰', '📄'];
        const elementCount = 15;

        // Mevcut elemanları temizle
        floatingBg.innerHTML = '';

        for (let i = 0; i < elementCount; i++) {
            const element = document.createElement('div');
            element.className = 'floating-element';
            element.textContent = elements[Math.floor(Math.random() * elements.length)];
            
            // Rastgele pozisyon ve timing
            element.style.left = Math.random() * 100 + '%';
            element.style.animationDelay = Math.random() * 15 + 's';
            element.style.animationDuration = (Math.random() * 10 + 15) + 's';
            element.dataset.speed = Math.floor(Math.random() * 4) + 1;
            
            floatingBg.appendChild(element);
        }
    }

    // === NAVBAR SCROLL EFFECT ===
    function handleNavbarScroll() {
        if (!navbar) return;

        const scrollThreshold = 100;
        let lastScrollY = window.scrollY;
        let ticking = false;

        function updateNavbar() {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > scrollThreshold) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Navbar gizleme/gösterme (opsiyonel)
            if (currentScrollY > lastScrollY && currentScrollY > 200) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }

            lastScrollY = currentScrollY;
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });
    }

    // === SMOOTH SCROLLING ===
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Boş href kontrolü
                if (href === '#') {
                    e.preventDefault();
                    return;
                }

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    const navbarHeight = navbar ? navbar.offsetHeight : 0;
                    const targetPosition = target.offsetTop - navbarHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Mobil menüyü kapat
                    closeMobileMenu();
                }
            });
        });
    }

    // === MOBILE MENU ===
    function initMobileMenu() {
        if (!mobileMenuToggle) return;

        const navLinksContainer = document.querySelector('.nav-links-container');
        
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            
            if (navLinksContainer) {
                navLinksContainer.classList.toggle('mobile-open');
                body.classList.toggle('menu-open');
            }
        });

        // Menü dışına tıklayınca kapat
        document.addEventListener('click', function(e) {
            if (!navbar.contains(e.target) && navLinksContainer && navLinksContainer.classList.contains('mobile-open')) {
                closeMobileMenu();
            }
        });

        // ESC tuşu ile menüyü kapat
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navLinksContainer && navLinksContainer.classList.contains('mobile-open')) {
                closeMobileMenu();
            }
        });
    }

    function closeMobileMenu() {
        const navLinksContainer = document.querySelector('.nav-links-container');
        
        if (mobileMenuToggle) {
            mobileMenuToggle.classList.remove('active');
        }
        
        if (navLinksContainer) {
            navLinksContainer.classList.remove('mobile-open');
        }
        
        body.classList.remove('menu-open');
    }

    // === ACTIVE NAVIGATION LINK ===
    function updateActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        let currentSectionId = '';
        const scrollPosition = window.scrollY + 200;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            
            if (href === `#${currentSectionId}`) {
                link.classList.add('active');
            }
        });
    }

    // === PARALLAX EFFECT ===
    function initParallaxEffect() {
        const parallaxElements = document.querySelectorAll('.parallax-element');
        let ticking = false;

        function updateParallax() {
            const scrollY = window.scrollY;

            parallaxElements.forEach(element => {
                const speed = element.dataset.speed || 0.5;
                const yPos = -(scrollY * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });

            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }

        if (parallaxElements.length > 0) {
            window.addEventListener('scroll', requestTick, { passive: true });
        }
    }

    // === COUNTER ANIMATION ===
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            const suffix = counter.textContent.replace(/[\d]/g, '');
            let current = 0;
            const increment = target / 100;
            const duration = 2000; // 2 saniye
            const stepTime = duration / 100;

            const timer = setInterval(() => {
                current += increment;
                
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }

                counter.textContent = Math.floor(current) + suffix;
            }, stepTime);
        });
    }

    // === INTERSECTION OBSERVER ===
    function initIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    
                    // Counter animasyonu için özel kontrol
                    if (entry.target.classList.contains('testimonials-stats')) {
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        // Gözlemlenecek elementleri seç
        const revealElements = document.querySelectorAll('.reveal, .service-card, .testimonial-card, .gallery-item, .process-step, .guarantee-item');
        
        revealElements.forEach(element => {
            element.classList.add('reveal');
            observer.observe(element);
        });

        // Stats bölümünü de gözlemle
        const statsSection = document.querySelector('.testimonials-stats');
        if (statsSection) {
            observer.observe(statsSection);
        }
    }

    // === FORM HANDLING ===
    function initFormHandling() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                
                // Loading durumu
                submitBtn.textContent = 'Gönderiliyor...';
                submitBtn.disabled = true;
                
                // Simüle edilmiş form gönderimi
                setTimeout(() => {
                    // Başarı mesajı göster
                    showNotification('Mesajınız başarıyla gönderildi!', 'success');
                    
                    // Formu sıfırla
                    this.reset();
                    
                    // Butonu normale döndür
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            });
        });
    }

    // === NOTIFICATION SYSTEM ===
    function showNotification(message, type = 'info') {
        // Notification container oluştur (yoksa)
        let container = document.querySelector('.notification-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'notification-container';
            document.body.appendChild(container);
        }

        // Notification elementi oluştur
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">
                    ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
                </span>
                <span class="notification-message">${message}</span>
            </div>
            <button class="notification-close">×</button>
        `;

        // Container'a ekle
        container.appendChild(notification);

        // Animasyon için timeout
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Otomatik kapat
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);

        // Manuel kapatma
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            hideNotification(notification);
        });
    }

    function hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }

    // === LAZY LOADING ===
    function initLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for older browsers
            images.forEach(img => {
                img.src = img.dataset.src;
                img.classList.remove('lazy');
            });
        }
    }

    // === KEYBOARD NAVIGATION ===
    function initKeyboardNavigation() {
        // Tab navigation için focus görünürlüğü
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            body.classList.remove('keyboard-navigation');
        });
    }

    // === PERFORMANCE MONITORING ===
    function initPerformanceMonitoring() {
        // Page load time
        window.addEventListener('load', function() {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`Sayfa yüklenme süresi: ${loadTime}ms`);
        });

        // Scroll performance
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                // Scroll işlemi tamamlandı
            }, 100);
        }, { passive: true });
    }

    // === UTILITY FUNCTIONS ===
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func.apply(this, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(this, args);
        };
    }

    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // === ERROR HANDLING ===
    window.addEventListener('error', function(e) {
        console.error('JavaScript hatası:', e.error);
        // Hata raporlama servisi ile entegrasyon yapılabilir
    });

    // === SCROLL TO TOP ===
    function initScrollToTop() {
        const scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.className = 'scroll-to-top';
        scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollToTopBtn.setAttribute('aria-label', 'Başa dön');
        document.body.appendChild(scrollToTopBtn);

        const debouncedScroll = debounce(() => {
            if (window.scrollY > 500) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        }, 100);

        window.addEventListener('scroll', debouncedScroll, { passive: true });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // === FONT LOADING ===
    function initFontLoading() {
        if ('fonts' in document) {
            document.fonts.ready.then(() => {
                body.classList.add('fonts-loaded');
            });
        }
    }

    // === INIT FUNCTIONS ===
    function init() {
        try {
            hidePreloader();
            createFloatingElements();
            handleNavbarScroll();
            initSmoothScrolling();
            initMobileMenu();
            initParallaxEffect();
            initIntersectionObserver();
            initFormHandling();
            initLazyLoading();
            initKeyboardNavigation();
            initPerformanceMonitoring();
            initScrollToTop();
            initFontLoading();

            // Scroll event listener for active nav
            const throttledScroll = throttle(() => {
                updateActiveNavLink();
            }, 100);
            
            window.addEventListener('scroll', throttledScroll, { passive: true });

            console.log('Mavi Güneş Sahaf - Site başarıyla yüklendi! 📚');
        } catch (error) {
            console.error('Initialization error:', error);
        }
    }

    // Initialize everything
    init();

    // === GLOBAL FUNCTIONS ===
    window.MaviGunesSahaf = {
        showNotification,
        hideNotification,
        closeMobileMenu,
        debounce,
        throttle
    };
});

// === SERVICE WORKER REGISTRATION ===
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('SW registered: ', registration);
            })
            .catch(registrationError => {
                console.log('SW registration failed: ', registrationError);
            });
    });
}


/* ====================================
   MAVI GÜNEŞ SAHAF - ENHANCED NAVBAR JS
   main.js dosyasına eklenecek
   ===================================== */

// === ENHANCED NAVBAR CONTROLLER ===
class EnhancedNavbar {
    constructor() {
        this.navbar = document.getElementById('navbar');
        this.mobileToggle = document.getElementById('mobileMenuToggle');
        this.mobileOverlay = document.getElementById('mobileMenuOverlay');
        this.mobileClose = document.getElementById('mobileClose');
        this.navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
        this.scrollProgressBar = document.querySelector('.scroll-progress-bar');
        this.body = document.body;
        
        // State variables
        this.isScrolled = false;
        this.isMobileMenuOpen = false;
        this.lastScrollY = window.scrollY;
        this.scrollDirection = 'up';
        
        // Settings
        this.scrollThreshold = 100;
        
        this.init();
    }

    init() {
        if (!this.navbar) return;
        
        this.bindEvents();
        this.updateActiveLink();
        this.initScrollProgress();
        this.addAccessibilityFeatures();
        
        console.log('🧭 Enhanced Navbar initialized');
    }

    bindEvents() {
        // Scroll events
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), 16), { passive: true });
        
        // Mobile menu events
        if (this.mobileToggle) {
            this.mobileToggle.addEventListener('click', this.toggleMobileMenu.bind(this));
        }
        
        if (this.mobileClose) {
            this.mobileClose.addEventListener('click', this.closeMobileMenu.bind(this));
        }
        
        if (this.mobileOverlay) {
            this.mobileOverlay.addEventListener('click', (e) => {
                if (e.target === this.mobileOverlay) {
                    this.closeMobileMenu();
                }
            });
        }
        
        // Navigation link events
        this.navLinks.forEach(link => {
            link.addEventListener('click', this.handleNavClick.bind(this));
        });
        
        // Keyboard events
        document.addEventListener('keydown', this.handleKeydown.bind(this));
        
        // Resize events
        window.addEventListener('resize', this.debounce(this.handleResize.bind(this), 250));
        
        // Logo error handling
        this.handleLogoError();
    }

    handleScroll() {
        const currentScrollY = window.scrollY;
        const scrollDifference = Math.abs(currentScrollY - this.lastScrollY);
        
        // Minimum scroll difference to trigger changes
        if (scrollDifference < 5) return;
        
        // Update scroll direction
        this.scrollDirection = currentScrollY > this.lastScrollY ? 'down' : 'up';
        
        // Update scrolled state
        const wasScrolled = this.isScrolled;
        this.isScrolled = currentScrollY > this.scrollThreshold;
        
        if (this.isScrolled !== wasScrolled) {
            this.updateScrolledState();
        }
        
        // Update scroll progress
        this.updateScrollProgress();
        
        // Update active navigation link
        this.updateActiveLink();
        
        this.lastScrollY = currentScrollY;
    }

    updateScrolledState() {
        if (this.isScrolled) {
            this.navbar.classList.add('scrolled');
        } else {
            this.navbar.classList.remove('scrolled');
        }
    }

    updateScrollProgress() {
        if (!this.scrollProgressBar) return;
        
        const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollProgress = (window.scrollY / documentHeight) * 100;
        this.scrollProgressBar.style.width = `${Math.min(scrollProgress, 100)}%`;
    }

    initScrollProgress() {
        if (!this.scrollProgressBar) return;
        this.updateScrollProgress();
    }

    toggleMobileMenu() {
        this.isMobileMenuOpen = !this.isMobileMenuOpen;
        
        if (this.isMobileMenuOpen) {
            this.openMobileMenu();
        } else {
            this.closeMobileMenu();
        }
    }

    openMobileMenu() {
        this.mobileToggle.classList.add('active');
        this.mobileToggle.setAttribute('aria-expanded', 'true');
        this.mobileOverlay.classList.add('active');
        this.body.classList.add('menu-open');
        
        // Prevent body scroll
        this.body.style.overflow = 'hidden';
        
        // Focus management
        const firstLink = this.mobileOverlay.querySelector('.mobile-nav-link');
        if (firstLink) {
            setTimeout(() => firstLink.focus(), 300);
        }
        
        // Animate items
        this.animateMobileMenuItems();
    }

    closeMobileMenu() {
        this.mobileToggle.classList.remove('active');
        this.mobileToggle.setAttribute('aria-expanded', 'false');
        this.mobileOverlay.classList.remove('active');
        this.body.classList.remove('menu-open');
        
        // Restore body scroll
        this.body.style.overflow = '';
        
        // Return focus to toggle button
        this.mobileToggle.focus();
        
        this.isMobileMenuOpen = false;
    }

    animateMobileMenuItems() {
        const items = this.mobileOverlay.querySelectorAll('.mobile-nav-link, .mobile-cta-btn');
        items.forEach((item, index) => {
            item.style.animationDelay = `${(index + 1) * 0.1}s`;
            item.classList.add('animate-in');
        });
    }

    handleNavClick(event) {
        const link = event.currentTarget;
        const href = link.getAttribute('href');
        
        // Handle internal links (sections)
        if (href && href.startsWith('#') && href !== '#') {
            event.preventDefault();
            this.scrollToSection(href);
        }
        
        // Close mobile menu if open
        if (this.isMobileMenuOpen) {
            this.closeMobileMenu();
        }
        
        // Update active state
        this.setActiveLink(link);
        
        // Track navigation
        this.trackNavigation(link);
    }

    scrollToSection(href) {
        const target = document.querySelector(href);
        if (!target) return;
        
        const navbarHeight = this.navbar.offsetHeight;
        const targetPosition = target.offsetTop - navbarHeight - 20;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }

    updateActiveLink() {
        const sections = document.querySelectorAll('section[id], main[id]');
        const scrollPosition = window.scrollY + 200;
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });
        
        // Update active states
        this.navLinks.forEach(link => {
            const href = link.getAttribute('href');
            link.classList.remove('active');
            
            if (href === `#${currentSection}` || 
                (currentSection === '' && (href === '/' || href === ''))) {
                link.classList.add('active');
            }
        });
    }

    setActiveLink(activeLink) {
        this.navLinks.forEach(link => link.classList.remove('active'));
        activeLink.classList.add('active');
    }

    handleKeydown(event) {
        // ESC key closes mobile menu
        if (event.key === 'Escape' && this.isMobileMenuOpen) {
            this.closeMobileMenu();
        }
        
        // Tab navigation in mobile menu
        if (event.key === 'Tab' && this.isMobileMenuOpen) {
            this.handleTabNavigation(event);
        }
    }

    handleTabNavigation(event) {
        const focusableElements = this.mobileOverlay.querySelectorAll(
            'a, button, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        if (event.shiftKey && document.activeElement === firstElement) {
            event.preventDefault();
            lastElement.focus();
        } else if (!event.shiftKey && document.activeElement === lastElement) {
            event.preventDefault();
            firstElement.focus();
        }
    }

    handleResize() {
        // Close mobile menu on resize to desktop
        if (window.innerWidth > 768 && this.isMobileMenuOpen) {
            this.closeMobileMenu();
        }
    }

    handleLogoError() {
        const logo = this.navbar.querySelector('.logo');
        const logoFallback = this.navbar.querySelector('.logo-fallback');
        
        if (logo && logoFallback) {
            logo.addEventListener('error', () => {
                logo.style.opacity = '0';
                logoFallback.style.opacity = '1';
            });
            
            logo.addEventListener('load', () => {
                logo.style.opacity = '1';
                logoFallback.style.opacity = '0';
            });
        }
    }

    addAccessibilityFeatures() {
        // Add ARIA labels
        if (this.mobileToggle) {
            this.mobileToggle.setAttribute('aria-label', 'Menüyü aç/kapat');
            this.mobileToggle.setAttribute('aria-expanded', 'false');
        }
        
        // Add skip link
        this.addSkipLink();
    }

    addSkipLink() {
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.textContent = 'Ana içeriğe geç';
        skipLink.className = 'skip-link';
        skipLink.style.cssText = `
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary-color);
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1001;
            font-size: 14px;
            font-weight: 600;
            transition: top 0.3s ease;
        `;
        
        skipLink.addEventListener('focus', () => {
            skipLink.style.top = '6px';
        });
        
        skipLink.addEventListener('blur', () => {
            skipLink.style.top = '-40px';
        });
        
        document.body.insertBefore(skipLink, this.navbar);
    }

    trackNavigation(link) {
        const linkText = link.textContent.trim();
        const linkHref = link.getAttribute('href');
        
        // Send to analytics (replace with your analytics service)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'navbar_navigation', {
                link_text: linkText,
                link_url: linkHref
            });
        }
        
        console.log(`📊 Navigation: ${linkText} (${linkHref})`);
    }

    // Utility functions
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func.apply(this, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(this, args);
        };
    }

    // Public API
    destroy() {
        // Remove event listeners
        window.removeEventListener('scroll', this.handleScroll);
        window.removeEventListener('resize', this.handleResize);
        document.removeEventListener('keydown', this.handleKeydown);
        
        // Reset states
        this.closeMobileMenu();
        
        console.log('🧭 Enhanced Navbar destroyed');
    }
}

// === NAVBAR ENHANCED MOBILE MENU ANIMATIONS ===
const navbarAnimationStyle = document.createElement('style');
navbarAnimationStyle.textContent = `
/* Mobile menu animations */
.mobile-nav-link,
.mobile-cta-btn {
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.4s ease;
}

.mobile-nav-link.animate-in,
.mobile-cta-btn.animate-in {
    opacity: 1;
    transform: translateX(0);
}

/* WhatsApp button bounce animation */
@keyframes bounceX {
    0%, 100% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(-3px) scale(1.1);
    }
    75% {
        transform: translateX(3px) scale(1.1);
    }
}

/* Focus styles for accessibility */
.nav-link:focus-visible,
.btn:focus-visible,
.mobile-menu-toggle:focus-visible,
.mobile-nav-link:focus-visible {
    outline: 2px solid var(--accent-color);
    outline-offset: 2px;
    box-shadow: 0 0 0 4px rgba(247, 191, 79, 0.2);
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .navbar {
        background: var(--bg-primary);
        border-bottom: 2px solid var(--text-primary);
    }
    
    .nav-link,
    .btn {
        border: 1px solid currentColor;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .navbar,
    .nav-link,
    .btn,
    .mobile-menu-toggle *,
    .mobile-menu-overlay,
    .scroll-progress-bar {
        animation: none !important;
        transition-duration: 0.01ms !important;
    }
    
    .pulse-ring {
        display: none;
    }
}
`;
document.head.appendChild(navbarAnimationStyle);

// === NAVBAR INITIALIZATION ===
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Enhanced Navbar
    const enhancedNavbar = new EnhancedNavbar();
    
    // Phone number formatting for buttons
    const phoneButtons = document.querySelectorAll('a[href^="tel:"]');
    phoneButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log('📞 Phone call initiated:', this.href);
        });
    });
    
    // WhatsApp button tracking
    const whatsappButtons = document.querySelectorAll('a[href*="wa.me"]');
    whatsappButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log('💬 WhatsApp opened:', this.href);
        });
    });
    
    // Expose globally for debugging
    window.EnhancedNavbar = enhancedNavbar;
    
    // Add to existing MaviGunesSahaf object
    if (window.MaviGunesSahaf) {
        window.MaviGunesSahaf.navbar = enhancedNavbar;
    } else {
        window.MaviGunesSahaf = {
            navbar: enhancedNavbar
        };
    }
    
    console.log('✅ Navbar enhanced JavaScript loaded successfully');
});

// === NAVBAR UTILITY FUNCTIONS ===

// Function to update navbar active state manually
function updateNavbarActive(page) {
    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        if (href === `/${page}` || href === page || (page === 'home' && (href === '/' || href === ''))) {
            link.classList.add('active');
        }
    });
}

// Function to show/hide navbar programmatically
function toggleNavbar(show = true) {
    const navbar = document.getElementById('navbar');
    if (navbar) {
        if (show) {
            navbar.style.transform = 'translateY(0)';
            navbar.style.visibility = 'visible';
        } else {
            navbar.style.transform = 'translateY(-100%)';
            navbar.style.visibility = 'hidden';
        }
    }
}

// Function to highlight navbar item temporarily
function highlightNavItem(selector, duration = 2000) {
    const item = document.querySelector(selector);
    if (item) {
        item.style.background = 'var(--accent-color)';
        item.style.color = 'var(--text-primary)';
        item.style.transform = 'scale(1.05)';
        
        setTimeout(() => {
            item.style.background = '';
            item.style.color = '';
            item.style.transform = '';
        }, duration);
    }
}

// Expose utility functions globally
window.updateNavbarActive = updateNavbarActive;
window.toggleNavbar = toggleNavbar;
window.highlightNavItem = highlightNavItem;