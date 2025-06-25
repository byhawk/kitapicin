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