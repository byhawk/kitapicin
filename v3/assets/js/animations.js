/* ====================================
   MAVI GÜNEŞ SAHAF - ANIMASYON JAVASCRIPT
   Çeşitli animasyon efektleri ve etkileşimler
   ===================================== */

(function() {
    'use strict';

    // === ANIMATION CONTROLLER ===
    class AnimationController {
        constructor() {
            this.animations = new Map();
            this.observers = new Map();
            this.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            this.init();
        }

        init() {
            this.initScrollAnimations();
            this.initHoverAnimations();
            this.initTypewriter();
            this.initCounterAnimations();
            this.initParticleSystem();
            this.initMorphingShapes();
            this.initTextEffects();
            this.initCardAnimations();
            this.initFloatingElements();
        }

        // === SCROLL ANIMATIONS ===
        initScrollAnimations() {
            if (this.isReducedMotion) return;

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -10% 0px'
            };

            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.triggerScrollAnimation(entry.target);
                    }
                });
            }, observerOptions);

            // Scroll reveal elementleri
            const revealElements = document.querySelectorAll(
                '.reveal, .fade-in-up, .slide-in-left, .slide-in-right, .zoom-in, .bounce-in'
            );

            revealElements.forEach(element => {
                scrollObserver.observe(element);
            });

            this.observers.set('scroll', scrollObserver);
        }

        triggerScrollAnimation(element) {
            const animationType = this.getAnimationType(element);
            
            switch (animationType) {
                case 'reveal':
                    element.classList.add('revealed');
                    break;
                case 'fade-in-up':
                    element.classList.add('animate');
                    break;
                case 'slide-in-left':
                    element.classList.add('animate');
                    break;
                case 'slide-in-right':
                    element.classList.add('animate');
                    break;
                case 'zoom-in':
                    element.classList.add('animate');
                    break;
                case 'bounce-in':
                    element.classList.add('animate');
                    break;
            }

            // Stagger effect için child elementleri animate et
            this.animateStaggerChildren(element);
        }

        getAnimationType(element) {
            const classes = element.classList;
            if (classes.contains('reveal')) return 'reveal';
            if (classes.contains('fade-in-up')) return 'fade-in-up';
            if (classes.contains('slide-in-left')) return 'slide-in-left';
            if (classes.contains('slide-in-right')) return 'slide-in-right';
            if (classes.contains('zoom-in')) return 'zoom-in';
            if (classes.contains('bounce-in')) return 'bounce-in';
            return 'reveal';
        }

        animateStaggerChildren(parent) {
            const children = parent.querySelectorAll('.stagger-item');
            children.forEach((child, index) => {
                setTimeout(() => {
                    child.classList.add('animate');
                }, index * 100);
            });
        }

        // === HOVER ANIMATIONS ===
        initHoverAnimations() {
            const hoverElements = document.querySelectorAll(
                '.hover-grow, .hover-shrink, .hover-rotate, .hover-float, .hover-glow'
            );

            hoverElements.forEach(element => {
                this.addHoverEffect(element);
            });
        }

        addHoverEffect(element) {
            const hoverType = this.getHoverType(element);
            
            element.addEventListener('mouseenter', () => {
                this.applyHoverAnimation(element, hoverType, true);
            });

            element.addEventListener('mouseleave', () => {
                this.applyHoverAnimation(element, hoverType, false);
            });
        }

        getHoverType(element) {
            if (element.classList.contains('hover-grow')) return 'grow';
            if (element.classList.contains('hover-shrink')) return 'shrink';
            if (element.classList.contains('hover-rotate')) return 'rotate';
            if (element.classList.contains('hover-float')) return 'float';
            if (element.classList.contains('hover-glow')) return 'glow';
            return 'grow';
        }

        applyHoverAnimation(element, type, isHover) {
            if (this.isReducedMotion) return;

            switch (type) {
                case 'grow':
                    element.style.transform = isHover ? 'scale(1.05)' : 'scale(1)';
                    break;
                case 'shrink':
                    element.style.transform = isHover ? 'scale(0.95)' : 'scale(1)';
                    break;
                case 'rotate':
                    element.style.transform = isHover ? 'rotate(5deg)' : 'rotate(0deg)';
                    break;
                case 'float':
                    element.style.transform = isHover ? 'translateY(-10px)' : 'translateY(0)';
                    break;
                case 'glow':
                    element.style.boxShadow = isHover ? 
                        '0 0 20px rgba(45, 107, 120, 0.5)' : 
                        element.dataset.originalShadow || 'none';
                    break;
            }
        }

        // === TYPEWRITER EFFECT ===
        initTypewriter() {
            const typewriterElements = document.querySelectorAll('.typewriter');
            
            typewriterElements.forEach(element => {
                this.createTypewriterEffect(element);
            });
        }

        createTypewriterEffect(element) {
            if (this.isReducedMotion) return;

            const text = element.textContent;
            element.textContent = '';
            element.style.visibility = 'visible';

            let index = 0;
            const speed = 100; // ms per character

            const typeInterval = setInterval(() => {
                if (index < text.length) {
                    element.textContent += text.charAt(index);
                    index++;
                } else {
                    clearInterval(typeInterval);
                    element.classList.add('typing-complete');
                }
            }, speed);

            this.animations.set(`typewriter-${element.id || Date.now()}`, typeInterval);
        }

        // === COUNTER ANIMATIONS ===
        initCounterAnimations() {
            const counterElements = document.querySelectorAll('.counter');
            
            if (counterElements.length === 0) return;

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counterElements.forEach(element => {
                counterObserver.observe(element);
            });
        }

        animateCounter(element) {
            if (this.isReducedMotion) {
                return;
            }

            const finalValue = parseInt(element.dataset.count || element.textContent.replace(/\D/g, ''));
            const suffix = element.textContent.replace(/[\d,]/g, '');
            const duration = parseInt(element.dataset.duration || '2000');
            const startValue = 0;
            
            let currentValue = startValue;
            const increment = finalValue / (duration / 16); // 60fps
            
            const counterInterval = setInterval(() => {
                currentValue += increment;
                
                if (currentValue >= finalValue) {
                    currentValue = finalValue;
                    clearInterval(counterInterval);
                }
                
                element.textContent = Math.floor(currentValue).toLocaleString() + suffix;
            }, 16);

            this.animations.set(`counter-${element.id || Date.now()}`, counterInterval);
        }

        // === PARTICLE SYSTEM ===
        initParticleSystem() {
            const particleContainers = document.querySelectorAll('.particle-system');
            
            particleContainers.forEach(container => {
                this.createParticleSystem(container);
            });
        }

        createParticleSystem(container) {
            if (this.isReducedMotion) return;

            const particleCount = parseInt(container.dataset.particles || '50');
            const particleTypes = ['✨', '⭐', '💫', '🌟'];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.textContent = particleTypes[Math.floor(Math.random() * particleTypes.length)];
                
                // Random properties
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particle.style.fontSize = (Math.random() * 10 + 10) + 'px';
                particle.style.opacity = Math.random() * 0.5 + 0.3;
                
                container.appendChild(particle);
            }
        }

        // === MORPHING SHAPES ===
        initMorphingShapes() {
            const morphElements = document.querySelectorAll('.morph-shape');
            
            morphElements.forEach(element => {
                this.createMorphingAnimation(element);
            });
        }

        createMorphingAnimation(element) {
            if (this.isReducedMotion) return;

            const shapes = [
                '60% 40% 30% 70% / 60% 30% 70% 40%',
                '30% 60% 70% 40% / 50% 60% 30% 60%',
                '50% 50% 50% 50% / 50% 50% 50% 50%',
                '40% 60% 60% 40% / 60% 40% 50% 50%'
            ];

            let currentShape = 0;
            
            const morphInterval = setInterval(() => {
                currentShape = (currentShape + 1) % shapes.length;
                element.style.borderRadius = shapes[currentShape];
            }, 3000);

            this.animations.set(`morph-${element.id || Date.now()}`, morphInterval);
        }

        // === TEXT EFFECTS ===
        initTextEffects() {
            this.initTextGlow();
            this.initTextShuffle();
            this.initTextWave();
        }

        initTextGlow() {
            const glowElements = document.querySelectorAll('.text-glow');
            
            glowElements.forEach(element => {
                if (!this.isReducedMotion) {
                    element.classList.add('glow-active');
                }
            });
        }

        initTextShuffle() {
            const shuffleElements = document.querySelectorAll('.text-shuffle');
            
            shuffleElements.forEach(element => {
                this.createTextShuffle(element);
            });
        }

        createTextShuffle(element) {
            if (this.isReducedMotion) return;

            const originalText = element.textContent;
            const characters = '!<>-_\\/[]{}—=+*^?#________';
            
            element.addEventListener('mouseenter', () => {
                let iteration = 0;
                
                const shuffleInterval = setInterval(() => {
                    element.textContent = originalText
                        .split('')
                        .map((letter, index) => {
                            if (index < iteration) {
                                return originalText[index];
                            }
                            return characters[Math.floor(Math.random() * characters.length)];
                        })
                        .join('');
                    
                    if (iteration >= originalText.length) {
                        clearInterval(shuffleInterval);
                    }
                    
                    iteration += 1 / 3;
                }, 30);
            });
        }

        initTextWave() {
            const waveElements = document.querySelectorAll('.text-wave');
            
            waveElements.forEach(element => {
                this.createTextWave(element);
            });
        }

        createTextWave(element) {
            if (this.isReducedMotion) return;

            const text = element.textContent;
            element.innerHTML = '';
            
            text.split('').forEach((char, index) => {
                const span = document.createElement('span');
                span.textContent = char === ' ' ? '\u00A0' : char;
                span.style.animationDelay = `${index * 0.1}s`;
                span.classList.add('wave-char');
                element.appendChild(span);
            });
        }

        // === CARD ANIMATIONS ===
        initCardAnimations() {
            const cards = document.querySelectorAll('.card-hover, .service-card, .testimonial-card');
            
            cards.forEach(card => {
                this.addCardEffects(card);
            });
        }

        addCardEffects(card) {
            if (this.isReducedMotion) return;

            // 3D tilt effect
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
            });

            // Shimmer effect
            card.addEventListener('mouseenter', () => {
                if (!card.querySelector('.shimmer-overlay')) {
                    const shimmer = document.createElement('div');
                    shimmer.className = 'shimmer-overlay';
                    card.appendChild(shimmer);
                    
                    setTimeout(() => {
                        shimmer.remove();
                    }, 1000);
                }
            });
        }

        // === FLOATING ELEMENTS ===
        initFloatingElements() {
            const floatingElements = document.querySelectorAll('.float-up, .float-down, .float-left-right');
            
            floatingElements.forEach(element => {
                if (!this.isReducedMotion) {
                    element.classList.add('floating-active');
                }
            });
        }

        // === RIPPLE EFFECT ===
        createRippleEffect(element, event) {
            if (this.isReducedMotion) return;

            const rect = element.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;
            
            const ripple = document.createElement('div');
            ripple.className = 'ripple-effect';
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            element.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // === UTILITY METHODS ===
        pauseAllAnimations() {
            this.animations.forEach(animation => {
                if (typeof animation === 'number') {
                    clearInterval(animation);
                }
            });
        }

        resumeAllAnimations() {
            // Resume logic if needed
        }

        destroy() {
            this.pauseAllAnimations();
            this.observers.forEach(observer => {
                observer.disconnect();
            });
            this.animations.clear();
            this.observers.clear();
        }
    }

    // === SCROLL-TRIGGERED ANIMATIONS ===
    class ScrollAnimations {
        constructor() {
            this.elements = [];
            this.init();
        }

        init() {
            this.setupScrollTriggers();
            this.bindScrollEvents();
        }

        setupScrollTriggers() {
            const triggers = document.querySelectorAll('[data-scroll-trigger]');
            
            triggers.forEach(trigger => {
                this.elements.push({
                    element: trigger,
                    animation: trigger.dataset.scrollTrigger,
                    offset: parseInt(trigger.dataset.scrollOffset || '0'),
                    delay: parseInt(trigger.dataset.scrollDelay || '0'),
                    triggered: false
                });
            });
        }

        bindScrollEvents() {
            const throttledScroll = this.throttle(() => {
                this.checkScrollTriggers();
            }, 16);

            window.addEventListener('scroll', throttledScroll, { passive: true });
        }

        checkScrollTriggers() {
            const scrollTop = window.pageYOffset;
            const windowHeight = window.innerHeight;

            this.elements.forEach(item => {
                if (item.triggered) return;

                const rect = item.element.getBoundingClientRect();
                const elementTop = rect.top + scrollTop;
                const triggerPoint = elementTop - windowHeight + item.offset;

                if (scrollTop > triggerPoint) {
                    setTimeout(() => {
                        this.triggerAnimation(item);
                    }, item.delay);
                    item.triggered = true;
                }
            });
        }

        triggerAnimation(item) {
            const { element, animation } = item;
            
            switch (animation) {
                case 'fadeIn':
                    element.classList.add('animate-fade-in');
                    break;
                case 'slideUp':
                    element.classList.add('animate-slide-up');
                    break;
                case 'slideLeft':
                    element.classList.add('animate-slide-left');
                    break;
                case 'slideRight':
                    element.classList.add('animate-slide-right');
                    break;
                case 'zoomIn':
                    element.classList.add('animate-zoom-in');
                    break;
                case 'rotateIn':
                    element.classList.add('animate-rotate-in');
                    break;
                default:
                    element.classList.add('animate-fade-in');
            }
        }

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
    }

    // === MOUSE FOLLOWER ===
    class MouseFollower {
        constructor() {
            this.cursor = null;
            this.isActive = false;
            this.init();
        }

        init() {
            if (window.innerWidth < 768) return; // Mobile'da aktif etme

            this.createCursor();
            this.bindEvents();
        }

        createCursor() {
            this.cursor = document.createElement('div');
            this.cursor.className = 'custom-cursor';
            document.body.appendChild(this.cursor);
        }

        bindEvents() {
            document.addEventListener('mousemove', (e) => {
                if (this.cursor) {
                    this.cursor.style.left = e.clientX + 'px';
                    this.cursor.style.top = e.clientY + 'px';
                }
            });

            // Hover effects
            const hoverElements = document.querySelectorAll('a, button, .card-hover');
            
            hoverElements.forEach(element => {
                element.addEventListener('mouseenter', () => {
                    if (this.cursor) {
                        this.cursor.classList.add('cursor-hover');
                    }
                });

                element.addEventListener('mouseleave', () => {
                    if (this.cursor) {
                        this.cursor.classList.remove('cursor-hover');
                    }
                });
            });
        }
    }

    // === INITIALIZATION ===
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize animation systems
        const animationController = new AnimationController();
        const scrollAnimations = new ScrollAnimations();
        const mouseFollower = new MouseFollower();

        // Add ripple effect to buttons
        const rippleButtons = document.querySelectorAll('.btn, .ripple');
        rippleButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                animationController.createRippleEffect(button, e);
            });
        });

        // Global animation controls
        window.addEventListener('beforeunload', () => {
            animationController.destroy();
        });

        // Expose animation controller globally
        window.AnimationController = animationController;
        
        console.log('🎨 Animation system initialized');
    });

})();