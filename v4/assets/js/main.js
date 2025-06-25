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


// === ENHANCED NAVBAR CONTROLLER ===
class EnhancedNavbar {
    constructor() {
        this.navbar = document.getElementById('navbar');
        this.mobileToggle = document.getElementById('mobileMenuToggle');
        this.navLinksContainer = document.querySelector('.nav-links-container');
        this.navLinks = document.querySelectorAll('.nav-link');
        this.body = document.body;
        
        // State variables
        this.isScrolled = false;
        this.isMobileMenuOpen = false;
        this.lastScrollY = window.scrollY;
        this.scrollDirection = 'up';
        this.hideTimeout = null;
        
        // Settings
        this.scrollThreshold = 100;
        this.hideNavbarOnScroll = false; // Set to true if you want auto-hide
        this.autoHideDelay = 3000;
        
        this.init();
    }

    init() {
        if (!this.navbar) return;
        
        this.bindEvents();
        this.setupIntersectionObserver();
        this.addAccessibilityFeatures();
        this.initializeNavbar();
        
        console.log('🧭 Enhanced Navbar initialized');
    }

    initializeNavbar() {
        // Set initial active state
        this.updateActiveLink();
        
        // Add initial classes
        this.navbar.classList.add('navbar-initialized');
        
        // Setup search functionality if exists
        this.initSearch();
    }

    bindEvents() {
        // Scroll events
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), 16), { passive: true });
        
        // Mobile menu events
        if (this.mobileToggle) {
            this.mobileToggle.addEventListener('click', this.toggleMobileMenu.bind(this));
        }
        
        // Navigation link events
        this.navLinks.forEach(link => {
            link.addEventListener('click', this.handleNavClick.bind(this));
            link.addEventListener('mouseenter', this.handleNavHover.bind(this));
            link.addEventListener('mouseleave', this.handleNavLeave.bind(this));
        });
        
        // Close mobile menu on outside click
        document.addEventListener('click', this.handleOutsideClick.bind(this));
        
        // Keyboard events
        document.addEventListener('keydown', this.handleKeydown.bind(this));
        
        // Resize events
        window.addEventListener('resize', this.debounce(this.handleResize.bind(this), 250));
        
        // Button events
        this.setupButtonEvents();
        
        // Mouse events for auto-hide
        if (this.hideNavbarOnScroll) {
            this.navbar.addEventListener('mouseenter', this.cancelAutoHide.bind(this));
            this.navbar.addEventListener('mouseleave', this.startAutoHide.bind(this));
        }
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
        
        // Handle navbar visibility
        if (this.hideNavbarOnScroll) {
            this.handleNavbarVisibility(currentScrollY);
        }
        
        // Update active navigation link
        this.updateActiveLink();
        
        this.lastScrollY = currentScrollY;
    }

    updateScrolledState() {
        if (this.isScrolled) {
            this.navbar.classList.add('scrolled');
            this.navbar.style.setProperty('--navbar-bg-opacity', '0.98');
        } else {
            this.navbar.classList.remove('scrolled');
            this.navbar.style.setProperty('--navbar-bg-opacity', '0.95');
        }
    }

    handleNavbarVisibility(currentScrollY) {
        const scrollingDown = this.scrollDirection === 'down';
        const isAtTop = currentScrollY < this.scrollThreshold;
        
        if (scrollingDown && !isAtTop && !this.isMobileMenuOpen) {
            this.hideNavbar();
        } else {
            this.showNavbar();
        }
    }

    hideNavbar() {
        this.navbar.style.transform = 'translateY(-100%)';
        this.navbar.classList.add('hidden');
    }

    showNavbar() {
        this.navbar.style.transform = 'translateY(0)';
        this.navbar.classList.remove('hidden');
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
        this.navLinksContainer.classList.add('mobile-open');
        this.body.classList.add('menu-open');
        
        // Prevent body scroll
        this.body.style.overflow = 'hidden';
        
        // Focus management
        const firstLink = this.navLinksContainer.querySelector('.nav-link');
        if (firstLink) {
            setTimeout(() => firstLink.focus(), 300);
        }
        
        // Animate items
        this.animateMobileMenuItems();
        
        // Show navbar if hidden
        if (this.hideNavbarOnScroll) {
            this.showNavbar();
        }
    }

    closeMobileMenu() {
        this.mobileToggle.classList.remove('active');
        this.navLinksContainer.classList.remove('mobile-open');
        this.body.classList.remove('menu-open');
        
        // Restore body scroll
        this.body.style.overflow = '';
        
        // Return focus to toggle button
        this.mobileToggle.focus();
    }

    animateMobileMenuItems() {
        const items = this.navLinksContainer.querySelectorAll('.nav-link, .btn');
        items.forEach((item, index) => {
            item.style.animationDelay = `${(index + 1) * 0.1}s`;
        });
    }

    handleNavClick(event) {
        const link = event.currentTarget;
        const href = link.getAttribute('href');
        
        // Handle internal links
        if (href && href.startsWith('#')) {
            event.preventDefault();
            this.scrollToSection(href);
            
            // Close mobile menu if open
            if (this.isMobileMenuOpen) {
                this.closeMobileMenu();
            }
        }
        
        // Update active state
        this.setActiveLink(link);
        
        // Add click effect
        this.addRippleEffect(link, event);
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

    addRippleEffect(element, event) {
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        const ripple = document.createElement('div');
        ripple.className = 'nav-ripple-effect';
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: radial-gradient(circle, rgba(45, 107, 120, 0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: scale(0);
            animation: navRipple 0.6s ease-out;
            pointer-events: none;
            z-index: 0;
        `;
        
        element.style.position = 'relative';
        element.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }

    handleNavHover(event) {
        const link = event.currentTarget;
        link.classList.add('hovered');
        
        // Add hover sound effect (if enabled)
        // this.playHoverSound();
    }

    handleNavLeave(event) {
        const link = event.currentTarget;
        link.classList.remove('hovered');
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
                (currentSection === '' && href === '/') ||
                (window.location.pathname.includes(href.replace('#', '')) && href !== '#')) {
                link.classList.add('active');
            }
        });
    }

    setActiveLink(activeLink) {
        this.navLinks.forEach(link => link.classList.remove('active'));
        activeLink.classList.add('active');
    }

    handleOutsideClick(event) {
        if (!this.navbar.contains(event.target) && this.isMobileMenuOpen) {
            this.closeMobileMenu();
        }
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
        const focusableElements = this.navLinksContainer.querySelectorAll(
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
        
        // Recalculate navbar dimensions
        this.updateNavbarDimensions();
    }

    updateNavbarDimensions() {
        const navbarHeight = this.navbar.offsetHeight;
        document.documentElement.style.setProperty('--navbar-height', `${navbarHeight}px`);
    }

    setupButtonEvents() {
        const buttons = this.navbar.querySelectorAll('.btn');
        
        buttons.forEach(button => {
            button.addEventListener('click', this.handleButtonClick.bind(this));
            button.addEventListener('mouseenter', this.handleButtonHover.bind(this));
        });
    }

    handleButtonClick(event) {
        const button = event.currentTarget;
        
        // Add loading state for external links
        if (button.href && button.target === '_blank') {
            this.addLoadingState(button);
        }
        
        // Track button clicks (analytics)
        this.trackButtonClick(button);
    }

    handleButtonHover(event) {
        const button = event.currentTarget;
        
        // Preload external links on hover
        if (button.href && button.target === '_blank') {
            this.preloadLink(button.href);
        }
    }

    addLoadingState(button) {
        const originalText = button.innerHTML;
        button.classList.add('loading');
        button.disabled = true;
        
        setTimeout(() => {
            button.classList.remove('loading');
            button.disabled = false;
        }, 1000);
    }

    preloadLink(href) {
        const link = document.createElement('link');
        link.rel = 'prefetch';
        link.href = href;
        document.head.appendChild(link);
    }

    trackButtonClick(button) {
        const buttonText = button.textContent.trim();
        const buttonType = button.className.includes('btn-primary') ? 'primary' : 'secondary';
        
        // Send to analytics (replace with your analytics service)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'navbar_button_click', {
                button_text: buttonText,
                button_type: buttonType
            });
        }
        
        console.log(`📊 Button clicked: ${buttonText} (${buttonType})`);
    }

    setupIntersectionObserver() {
        const options = {
            threshold: 0.1,
            rootMargin: '-100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const id = entry.target.getAttribute('id');
                const navLink = document.querySelector(`a[href="#${id}"]`);
                
                if (entry.isIntersecting && navLink) {
                    this.setActiveLink(navLink);
                }
            });
        }, options);
        
        // Observe all sections
        document.querySelectorAll('section[id], main[id]').forEach(section => {
            observer.observe(section);
        });
    }

    addAccessibilityFeatures() {
        // Add ARIA labels
        if (this.mobileToggle) {
            this.mobileToggle.setAttribute('aria-label', 'Menüyü aç/kapat');
            this.mobileToggle.setAttribute('aria-expanded', 'false');
        }
        
        // Add skip link
        this.addSkipLink();
        
        // Improve focus visibility
        this.improveFocusVisibility();
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
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
            transition: top 0.3s;
        `;
        
        skipLink.addEventListener('focus', () => {
            skipLink.style.top = '6px';
        });
        
        skipLink.addEventListener('blur', () => {
            skipLink.style.top = '-40px';
        });
        
        document.body.insertBefore(skipLink, this.navbar);
    }

    improveFocusVisibility() {
        // Add focus-visible styles dynamically
        const style = document.createElement('style');
        style.textContent = `
            .nav-link:focus-visible,
            .btn:focus-visible,
            .mobile-menu-toggle:focus-visible {
                outline: 2px solid var(--accent-color);
                outline-offset: 2px;
                box-shadow: 0 0 0 4px rgba(247, 191, 79, 0.2);
            }
        `;
        document.head.appendChild(style);
    }

    initSearch() {
        const searchToggle = document.querySelector('.search-toggle');
        const searchInput = document.querySelector('.search-input');
        
        if (searchToggle && searchInput) {
            searchToggle.addEventListener('click', () => {
                searchInput.classList.toggle('active');
                if (searchInput.classList.contains('active')) {
                    searchInput.focus();
                }
            });
            
            searchInput.addEventListener('blur', () => {
                if (!searchInput.value) {
                    searchInput.classList.remove('active');
                }
            });
        }
    }

    startAutoHide() {
        if (this.hideTimeout) {
            clearTimeout(this.hideTimeout);
        }
        
        this.hideTimeout = setTimeout(() => {
            if (!this.isMobileMenuOpen && this.scrollDirection === 'down') {
                this.hideNavbar();
            }
        }, this.autoHideDelay);
    }

    cancelAutoHide() {
        if (this.hideTimeout) {
            clearTimeout(this.hideTimeout);
            this.hideTimeout = null;
        }
        this.showNavbar();
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
        document.removeEventListener('click', this.handleOutsideClick);
        document.removeEventListener('keydown', this.handleKeydown);
        
        // Reset states
        this.closeMobileMenu();
        this.showNavbar();
        
        console.log('🧭 Enhanced Navbar destroyed');
    }
}

// Initialize Enhanced Navbar when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const enhancedNavbar = new EnhancedNavbar();
    
    // Expose globally for debugging
    window.EnhancedNavbar = enhancedNavbar;
    
    // Add to existing MaviGunesSahaf object
    if (window.MaviGunesSahaf) {
        window.MaviGunesSahaf.navbar = enhancedNavbar;
    }
});

/* ====================================
   NAVBAR OTOMATIK AYARLAMA
   main.js'e ekleyin
   ===================================== */

// Navbar otomatik ayarlama fonksiyonu
function autoAdjustNavbar() {
    const navbar = document.querySelector('.navbar');
    const navContainer = document.querySelector('.nav-container');
    const navBrand = document.querySelector('.nav-brand');
    const navLinksContainer = document.querySelector('.nav-links-container');
    const navLinks = document.querySelector('.nav-links');
    const navCta = document.querySelector('.nav-cta');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    
    if (!navbar || !navContainer) return;
    
    function adjustLayout() {
        const containerWidth = navContainer.offsetWidth;
        const brandWidth = navBrand?.offsetWidth || 0;
        const ctaWidth = navCta?.offsetWidth || 0;
        const toggleWidth = mobileToggle?.offsetWidth || 0;
        
        // Kullanılabilir alan hesapla
        const availableSpace = containerWidth - brandWidth - ctaWidth - toggleWidth - 60; // 60px margin
        
        console.log('🔧 Navbar Ayarlama:', {
            containerWidth,
            brandWidth,
            ctaWidth,
            availableSpace
        });
        
        // Eğer alan yeterli değilse compact moda geç
        if (availableSpace < 400 && window.innerWidth > 768) {
            activateCompactMode();
        } else if (window.innerWidth > 768) {
            deactivateCompactMode();
        }
        
        // Mobile check
        if (window.innerWidth <= 768) {
            activateMobileMode();
        } else {
            deactivateMobileMode();
        }
    }
    
    function activateCompactMode() {
        navbar.classList.add('compact-mode');
        
        // Navigation linklerini kısalt
        const links = document.querySelectorAll('.nav-link span');
        links.forEach(span => {
            span.style.display = 'none';
        });
        
        // Button text'leri gizle
        const btnTexts = document.querySelectorAll('.btn-text, .btn-number, .btn-subtitle');
        btnTexts.forEach(text => {
            text.style.display = 'none';
        });
        
        // Butonları daha kompakt yap
        const buttons = document.querySelectorAll('.nav-cta .btn');
        buttons.forEach(btn => {
            btn.style.minWidth = '50px';
            btn.style.width = '50px';
            btn.style.height = '50px';
            btn.style.borderRadius = '50%';
            btn.style.padding = '0';
        });
        
        console.log('✅ Compact mode aktif');
    }
    
    function deactivateCompactMode() {
        navbar.classList.remove('compact-mode');
        
        // Navigation linklerini göster
        const links = document.querySelectorAll('.nav-link span');
        links.forEach(span => {
            span.style.display = '';
        });
        
        // Button text'leri göster
        const btnTexts = document.querySelectorAll('.btn-text, .btn-number, .btn-subtitle');
        btnTexts.forEach(text => {
            text.style.display = '';
        });
        
        // Butonları normal boyuta döndür
        const buttons = document.querySelectorAll('.nav-cta .btn');
        buttons.forEach(btn => {
            btn.style.minWidth = '';
            btn.style.width = '';
            btn.style.height = '';
            btn.style.borderRadius = '';
            btn.style.padding = '';
        });
        
        console.log('✅ Normal mode aktif');
    }
    
    function activateMobileMode() {
        navLinksContainer.style.display = 'none';
        mobileToggle.style.display = 'flex';
    }
    
    function deactivateMobileMode() {
        navLinksContainer.style.display = 'flex';
        mobileToggle.style.display = 'none';
    }
    
    // İlk yükleme
    adjustLayout();
    
    // Resize olayında ayarla
    window.addEventListener('resize', debounce(adjustLayout, 100));
    
    // Font yükleme tamamlandığında tekrar ayarla
    if (document.fonts) {
        document.fonts.ready.then(adjustLayout);
    }
}

// Debounce fonksiyonu
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Force fix fonksiyonu (acil durum)
function forceFixNavbar() {
    console.log('🔧 Navbar zorla düzeltiliyor...');
    
    const navContainer = document.querySelector('.nav-container');
    if (navContainer) {
        navContainer.style.display = 'flex';
        navContainer.style.alignItems = 'center';
        navContainer.style.justifyContent = 'space-between';
        navContainer.style.width = '100%';
        navContainer.style.maxWidth = '1200px';
        navContainer.style.margin = '0 auto';
        navContainer.style.padding = '0 20px';
        navContainer.style.boxSizing = 'border-box';
    }
    
    const navLinksContainer = document.querySelector('.nav-links-container');
    if (navLinksContainer) {
        navLinksContainer.style.display = 'flex';
        navLinksContainer.style.alignItems = 'center';
        navLinksContainer.style.flex = '1';
        navLinksContainer.style.justifyContent = 'flex-end';
        navLinksContainer.style.gap = '20px';
    }
    
    const navCta = document.querySelector('.nav-cta');
    if (navCta) {
        navCta.style.display = 'flex';
        navCta.style.gap = '15px';
        navCta.style.flexShrink = '0';
    }
    
    console.log('✅ Navbar zorla düzeltildi');
}

// CSS override fonksiyonu
function addNavbarFixCSS() {
    const style = document.createElement('style');
    style.innerHTML = `
    /* Navbar Fix CSS */
    .nav-container {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding: 15px 20px !important;
        box-sizing: border-box !important;
    }
    
    .nav-brand {
        flex-shrink: 0 !important;
        min-width: 200px !important;
    }
    
    .nav-links-container {
        display: flex !important;
        align-items: center !important;
        flex: 1 !important;
        justify-content: flex-end !important;
        gap: 20px !important;
        overflow: hidden !important;
    }
    
    .nav-links {
        display: flex !important;
        gap: 25px !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
    }
    
    .nav-cta {
        display: flex !important;
        gap: 15px !important;
        flex-shrink: 0 !important;
        margin-left: 20px !important;
    }
    
    @media (max-width: 768px) {
        .nav-links-container {
            display: none !important;
        }
        
        .mobile-menu-toggle {
            display: flex !important;
        }
    }
    
    /* Compact mode styles */
    .navbar.compact-mode .nav-link span {
        display: none !important;
    }
    
    .navbar.compact-mode .btn-text,
    .navbar.compact-mode .btn-number,
    .navbar.compact-mode .btn-subtitle {
        display: none !important;
    }
    
    .navbar.compact-mode .nav-cta .btn {
        min-width: 50px !important;
        width: 50px !important;
        height: 50px !important;
        border-radius: 50% !important;
        padding: 0 !important;
    }
    `;
    document.head.appendChild(style);
}

// DOM yüklendiğinde çalıştır
document.addEventListener('DOMContentLoaded', function() {
    // CSS fix'i ekle
    addNavbarFixCSS();
    
    // Otomatik ayarlamayı başlat
    setTimeout(autoAdjustNavbar, 100);
    
    // Force fix'i de çalıştır (güvenlik için)
    setTimeout(forceFixNavbar, 200);
    
    console.log('🚀 Navbar auto-adjust sistemi başlatıldı');
});

// Global fonksiyonlar
window.forceFixNavbar = forceFixNavbar;
window.autoAdjustNavbar = autoAdjustNavbar;

// Console komutu
console.log(`
🔧 NAVBAR DEBUG COMMANDS:
- forceFixNavbar() : Navbar'ı zorla düzelt
- autoAdjustNavbar() : Otomatik ayarlamayı yeniden çalıştır
`);