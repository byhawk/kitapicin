/* ====================================
   MAVI GÜNEŞ SAHAF - BİLEŞEN JAVASCRIPT
   Modüler bileşenler ve özellikleri
   ===================================== */

(function() {
    'use strict';

    // === MODAL COMPONENT ===
    class Modal {
        constructor(modalId) {
            this.modal = document.getElementById(modalId);
            this.isOpen = false;
            this.init();
        }

        init() {
            if (!this.modal) return;

            this.bindEvents();
            this.createBackdrop();
        }

        createBackdrop() {
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop';
            this.modal.appendChild(backdrop);
        }

        bindEvents() {
            // Close buttons
            const closeButtons = this.modal.querySelectorAll('.modal-close, [data-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => this.close());
            });

            // Backdrop click
            this.modal.addEventListener('click', (e) => {
                if (e.target === this.modal || e.target.classList.contains('modal-backdrop')) {
                    this.close();
                }
            });

            // Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });
        }

        open() {
            this.modal.style.display = 'flex';
            document.body.classList.add('modal-open');
            
            setTimeout(() => {
                this.modal.classList.add('show');
                this.isOpen = true;
            }, 10);

            // Focus management
            const focusableElements = this.modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            if (focusableElements.length > 0) {
                focusableElements[0].focus();
            }
        }

        close() {
            this.modal.classList.remove('show');
            this.isOpen = false;
            
            setTimeout(() => {
                this.modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }, 300);
        }

        toggle() {
            this.isOpen ? this.close() : this.open();
        }
    }

    // === GALLERY COMPONENT ===
    class ImageGallery {
        constructor(gallerySelector) {
            this.gallery = document.querySelector(gallerySelector);
            this.currentIndex = 0;
            this.images = [];
            this.init();
        }

        init() {
            if (!this.gallery) return;

            this.collectImages();
            this.bindEvents();
            this.createLightbox();
        }

        collectImages() {
            const images = this.gallery.querySelectorAll('img');
            this.images = Array.from(images).map(img => ({
                src: img.src,
                alt: img.alt,
                caption: img.dataset.caption || img.alt
            }));
        }

        bindEvents() {
            this.gallery.addEventListener('click', (e) => {
                if (e.target.tagName === 'IMG') {
                    const index = Array.from(this.gallery.querySelectorAll('img')).indexOf(e.target);
                    this.openLightbox(index);
                }
            });
        }

        createLightbox() {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-backdrop"></div>
                <div class="lightbox-content">
                    <button class="lightbox-close">&times;</button>
                    <button class="lightbox-prev">&#8249;</button>
                    <button class="lightbox-next">&#8250;</button>
                    <img class="lightbox-image" src="" alt="">
                    <div class="lightbox-caption"></div>
                    <div class="lightbox-counter">
                        <span class="current">1</span> / <span class="total">${this.images.length}</span>
                    </div>
                </div>
            `;
            
            document.body.appendChild(lightbox);
            this.lightbox = lightbox;
            this.bindLightboxEvents();
        }

        bindLightboxEvents() {
            const closeBtn = this.lightbox.querySelector('.lightbox-close');
            const prevBtn = this.lightbox.querySelector('.lightbox-prev');
            const nextBtn = this.lightbox.querySelector('.lightbox-next');
            const backdrop = this.lightbox.querySelector('.lightbox-backdrop');

            closeBtn.addEventListener('click', () => this.closeLightbox());
            prevBtn.addEventListener('click', () => this.previousImage());
            nextBtn.addEventListener('click', () => this.nextImage());
            backdrop.addEventListener('click', () => this.closeLightbox());

            document.addEventListener('keydown', (e) => {
                if (!this.lightbox.classList.contains('active')) return;
                
                switch (e.key) {
                    case 'Escape':
                        this.closeLightbox();
                        break;
                    case 'ArrowLeft':
                        this.previousImage();
                        break;
                    case 'ArrowRight':
                        this.nextImage();
                        break;
                }
            });
        }

        openLightbox(index) {
            this.currentIndex = index;
            this.updateLightboxImage();
            this.lightbox.classList.add('active');
            document.body.classList.add('lightbox-open');
        }

        closeLightbox() {
            this.lightbox.classList.remove('active');
            document.body.classList.remove('lightbox-open');
        }

        previousImage() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            this.updateLightboxImage();
        }

        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
            this.updateLightboxImage();
        }

        updateLightboxImage() {
            const image = this.lightbox.querySelector('.lightbox-image');
            const caption = this.lightbox.querySelector('.lightbox-caption');
            const current = this.lightbox.querySelector('.current');
            
            const currentImage = this.images[this.currentIndex];
            
            image.src = currentImage.src;
            image.alt = currentImage.alt;
            caption.textContent = currentImage.caption;
            current.textContent = this.currentIndex + 1;
        }
    }

    // === TABS COMPONENT ===
    class Tabs {
        constructor(tabsSelector) {
            this.tabsContainer = document.querySelector(tabsSelector);
            this.activeTab = 0;
            this.init();
        }

        init() {
            if (!this.tabsContainer) return;

            this.tabs = this.tabsContainer.querySelectorAll('.tab-button');
            this.panels = this.tabsContainer.querySelectorAll('.tab-panel');
            
            this.bindEvents();
            this.setActiveTab(0);
        }

        bindEvents() {
            this.tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    this.setActiveTab(index);
                });

                tab.addEventListener('keydown', (e) => {
                    this.handleKeyNavigation(e, index);
                });
            });
        }

        handleKeyNavigation(e, currentIndex) {
            let targetIndex = currentIndex;

            switch (e.key) {
                case 'ArrowLeft':
                    targetIndex = currentIndex > 0 ? currentIndex - 1 : this.tabs.length - 1;
                    break;
                case 'ArrowRight':
                    targetIndex = currentIndex < this.tabs.length - 1 ? currentIndex + 1 : 0;
                    break;
                case 'Home':
                    targetIndex = 0;
                    break;
                case 'End':
                    targetIndex = this.tabs.length - 1;
                    break;
                default:
                    return;
            }

            e.preventDefault();
            this.setActiveTab(targetIndex);
            this.tabs[targetIndex].focus();
        }

        setActiveTab(index) {
            // Remove active class from all tabs and panels
            this.tabs.forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
                tab.tabIndex = -1;
            });

            this.panels.forEach(panel => {
                panel.classList.remove('active');
                panel.setAttribute('aria-hidden', 'true');
            });

            // Set active tab and panel
            this.tabs[index].classList.add('active');
            this.tabs[index].setAttribute('aria-selected', 'true');
            this.tabs[index].tabIndex = 0;

            this.panels[index].classList.add('active');
            this.panels[index].setAttribute('aria-hidden', 'false');

            this.activeTab = index;
        }
    }

    // === TOOLTIP COMPONENT ===
    class Tooltip {
        constructor() {
            this.tooltips = document.querySelectorAll('[data-tooltip]');
            this.activeTooltip = null;
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            this.tooltips.forEach(element => {
                element.addEventListener('mouseenter', (e) => {
                    this.showTooltip(e.target);
                });

                element.addEventListener('mouseleave', () => {
                    this.hideTooltip();
                });

                element.addEventListener('focus', (e) => {
                    this.showTooltip(e.target);
                });

                element.addEventListener('blur', () => {
                    this.hideTooltip();
                });
            });
        }

        showTooltip(element) {
            const text = element.dataset.tooltip;
            const position = element.dataset.tooltipPosition || 'top';
            
            if (!text) return;

            this.hideTooltip(); // Hide any existing tooltip

            const tooltip = document.createElement('div');
            tooltip.className = `tooltip tooltip-${position}`;
            tooltip.textContent = text;
            document.body.appendChild(tooltip);

            this.activeTooltip = tooltip;
            this.positionTooltip(element, tooltip, position);

            setTimeout(() => {
                tooltip.classList.add('show');
            }, 10);
        }

        hideTooltip() {
            if (this.activeTooltip) {
                this.activeTooltip.classList.remove('show');
                setTimeout(() => {
                    if (this.activeTooltip) {
                        this.activeTooltip.remove();
                        this.activeTooltip = null;
                    }
                }, 200);
            }
        }

        positionTooltip(element, tooltip, position) {
            const elementRect = element.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();
            
            let left, top;

            switch (position) {
                case 'top':
                    left = elementRect.left + elementRect.width / 2 - tooltipRect.width / 2;
                    top = elementRect.top - tooltipRect.height - 10;
                    break;
                case 'bottom':
                    left = elementRect.left + elementRect.width / 2 - tooltipRect.width / 2;
                    top = elementRect.bottom + 10;
                    break;
                case 'left':
                    left = elementRect.left - tooltipRect.width - 10;
                    top = elementRect.top + elementRect.height / 2 - tooltipRect.height / 2;
                    break;
                case 'right':
                    left = elementRect.right + 10;
                    top = elementRect.top + elementRect.height / 2 - tooltipRect.height / 2;
                    break;
            }

            // Ensure tooltip stays within viewport
            left = Math.max(10, Math.min(left, window.innerWidth - tooltipRect.width - 10));
            top = Math.max(10, Math.min(top, window.innerHeight - tooltipRect.height - 10));

            tooltip.style.left = left + 'px';
            tooltip.style.top = top + 'px';
        }
    }

    // === CAROUSEL/SLIDER COMPONENT ===
    class Carousel {
        constructor(carouselSelector) {
            this.carousel = document.querySelector(carouselSelector);
            this.currentSlide = 0;
            this.isAnimating = false;
            this.autoplayInterval = null;
            this.init();
        }

        init() {
            if (!this.carousel) return;

            this.slides = this.carousel.querySelectorAll('.carousel-slide');
            this.totalSlides = this.slides.length;
            
            if (this.totalSlides === 0) return;

            this.createControls();
            this.createIndicators();
            this.bindEvents();
            this.showSlide(0);
            
            // Auto-play if specified
            if (this.carousel.dataset.autoplay === 'true') {
                this.startAutoplay();
            }
        }

        createControls() {
            const prevBtn = document.createElement('button');
            prevBtn.className = 'carousel-prev';
            prevBtn.innerHTML = '&#8249;';
            prevBtn.setAttribute('aria-label', 'Previous slide');

            const nextBtn = document.createElement('button');
            nextBtn.className = 'carousel-next';
            nextBtn.innerHTML = '&#8250;';
            nextBtn.setAttribute('aria-label', 'Next slide');

            this.carousel.appendChild(prevBtn);
            this.carousel.appendChild(nextBtn);

            this.prevBtn = prevBtn;
            this.nextBtn = nextBtn;
        }

        createIndicators() {
            const indicators = document.createElement('div');
            indicators.className = 'carousel-indicators';

            for (let i = 0; i < this.totalSlides; i++) {
                const indicator = document.createElement('button');
                indicator.className = 'carousel-indicator';
                indicator.setAttribute('aria-label', `Go to slide ${i + 1}`);
                indicator.dataset.slide = i;
                indicators.appendChild(indicator);
            }

            this.carousel.appendChild(indicators);
            this.indicators = indicators.querySelectorAll('.carousel-indicator');
        }

        bindEvents() {
            this.prevBtn.addEventListener('click', () => this.previousSlide());
            this.nextBtn.addEventListener('click', () => this.nextSlide());

            this.indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => this.goToSlide(index));
            });

            // Keyboard navigation
            this.carousel.addEventListener('keydown', (e) => {
                switch (e.key) {
                    case 'ArrowLeft':
                        this.previousSlide();
                        break;
                    case 'ArrowRight':
                        this.nextSlide();
                        break;
                }
            });

            // Pause autoplay on hover
            this.carousel.addEventListener('mouseenter', () => this.stopAutoplay());
            this.carousel.addEventListener('mouseleave', () => {
                if (this.carousel.dataset.autoplay === 'true') {
                    this.startAutoplay();
                }
            });

            // Touch/swipe support
            this.addTouchSupport();
        }

        addTouchSupport() {
            let startX = 0;
            let endX = 0;

            this.carousel.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            }, { passive: true });

            this.carousel.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                this.handleSwipe();
            }, { passive: true });
        }

        handleSwipe() {
            const diffX = startX - endX;
            const threshold = 50;

            if (Math.abs(diffX) > threshold) {
                if (diffX > 0) {
                    this.nextSlide();
                } else {
                    this.previousSlide();
                }
            }
        }

        showSlide(index) {
            if (this.isAnimating) return;

            this.slides.forEach(slide => slide.classList.remove('active'));
            this.indicators.forEach(indicator => indicator.classList.remove('active'));

            this.slides[index].classList.add('active');
            this.indicators[index].classList.add('active');

            this.currentSlide = index;
        }

        nextSlide() {
            const nextIndex = (this.currentSlide + 1) % this.totalSlides;
            this.showSlide(nextIndex);
        }

        previousSlide() {
            const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.showSlide(prevIndex);
        }

        goToSlide(index) {
            this.showSlide(index);
        }

        startAutoplay() {
            const interval = parseInt(this.carousel.dataset.interval || '5000');
            this.autoplayInterval = setInterval(() => {
                this.nextSlide();
            }, interval);
        }

        stopAutoplay() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        }
    }

    // === ACCORDION COMPONENT ===
    class Accordion {
        constructor(accordionSelector) {
            this.accordion = document.querySelector(accordionSelector);
            this.init();
        }

        init() {
            if (!this.accordion) return;

            this.items = this.accordion.querySelectorAll('.accordion-item');
            this.bindEvents();
        }

        bindEvents() {
            this.items.forEach(item => {
                const trigger = item.querySelector('.accordion-trigger');
                const content = item.querySelector('.accordion-content');

                trigger.addEventListener('click', () => {
                    this.toggleItem(item, content);
                });

                trigger.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.toggleItem(item, content);
                    }
                });
            });
        }

        toggleItem(item, content) {
            const isOpen = item.classList.contains('active');
            
            // Close other items if not multi-expand
            if (!this.accordion.dataset.multiExpand) {
                this.items.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.accordion-content');
                        otherContent.style.maxHeight = null;
                    }
                });
            }

            if (isOpen) {
                item.classList.remove('active');
                content.style.maxHeight = null;
            } else {
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        }
    }

    // === DROPDOWN COMPONENT ===
    class Dropdown {
        constructor(dropdownSelector) {
            this.dropdown = document.querySelector(dropdownSelector);
            this.isOpen = false;
            this.init();
        }

        init() {
            if (!this.dropdown) return;

            this.trigger = this.dropdown.querySelector('.dropdown-trigger');
            this.menu = this.dropdown.querySelector('.dropdown-menu');
            this.items = this.dropdown.querySelectorAll('.dropdown-item');

            this.bindEvents();
        }

        bindEvents() {
            this.trigger.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggle();
            });

            this.trigger.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.toggle();
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    this.open();
                    this.focusFirstItem();
                }
            });

            // Handle item selection
            this.items.forEach((item, index) => {
                item.addEventListener('click', () => {
                    this.selectItem(item);
                });

                item.addEventListener('keydown', (e) => {
                    this.handleItemKeydown(e, index);
                });
            });

            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!this.dropdown.contains(e.target)) {
                    this.close();
                }
            });
        }

        handleItemKeydown(e, index) {
            let targetIndex = index;

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    targetIndex = index < this.items.length - 1 ? index + 1 : 0;
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    targetIndex = index > 0 ? index - 1 : this.items.length - 1;
                    break;
                case 'Escape':
                    this.close();
                    this.trigger.focus();
                    return;
                case 'Enter':
                    e.preventDefault();
                    this.selectItem(this.items[index]);
                    return;
            }

            this.items[targetIndex].focus();
        }

        selectItem(item) {
            const value = item.dataset.value || item.textContent;
            this.trigger.textContent = item.textContent;
            this.trigger.dataset.value = value;
            this.close();
            
            // Dispatch custom event
            this.dropdown.dispatchEvent(new CustomEvent('dropdown:select', {
                detail: { value, item }
            }));
        }

        open() {
            this.menu.classList.add('show');
            this.trigger.setAttribute('aria-expanded', 'true');
            this.isOpen = true;
        }

        close() {
            this.menu.classList.remove('show');
            this.trigger.setAttribute('aria-expanded', 'false');
            this.isOpen = false;
        }

        toggle() {
            this.isOpen ? this.close() : this.open();
        }

        focusFirstItem() {
            if (this.items.length > 0) {
                this.items[0].focus();
            }
        }
    }

    // === COMPONENT FACTORY ===
    class ComponentFactory {
        constructor() {
            this.components = new Map();
        }

        init() {
            this.initModals();
            this.initGalleries();
            this.initTabs();
            this.initTooltips();
            this.initCarousels();
            this.initAccordions();
            this.initDropdowns();
        }

        initModals() {
            const modals = document.querySelectorAll('[data-modal]');
            modals.forEach(modal => {
                const instance = new Modal(modal.id);
                this.components.set(`modal-${modal.id}`, instance);
            });

            // Modal triggers
            const triggers = document.querySelectorAll('[data-modal-target]');
            triggers.forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = trigger.dataset.modalTarget;
                    const modal = this.components.get(`modal-${targetId}`);
                    if (modal) modal.open();
                });
            });
        }

        initGalleries() {
            const galleries = document.querySelectorAll('.gallery-grid');
            galleries.forEach((gallery, index) => {
                const instance = new ImageGallery(`.gallery-grid:nth-child(${index + 1})`);
                this.components.set(`gallery-${index}`, instance);
            });
        }

        initTabs() {
            const tabContainers = document.querySelectorAll('.tabs');
            tabContainers.forEach((container, index) => {
                const instance = new Tabs(`.tabs:nth-child(${index + 1})`);
                this.components.set(`tabs-${index}`, instance);
            });
        }

        initTooltips() {
            const tooltip = new Tooltip();
            this.components.set('tooltip', tooltip);
        }

        initCarousels() {
            const carousels = document.querySelectorAll('.carousel');
            carousels.forEach((carousel, index) => {
                const instance = new Carousel(`.carousel:nth-child(${index + 1})`);
                this.components.set(`carousel-${index}`, instance);
            });
        }

        initAccordions() {
            const accordions = document.querySelectorAll('.accordion');
            accordions.forEach((accordion, index) => {
                const instance = new Accordion(`.accordion:nth-child(${index + 1})`);
                this.components.set(`accordion-${index}`, instance);
            });
        }

        initDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach((dropdown, index) => {
                const instance = new Dropdown(`.dropdown:nth-child(${index + 1})`);
                this.components.set(`dropdown-${index}`, instance);
            });
        }

        getComponent(id) {
            return this.components.get(id);
        }

        destroyAll() {
            this.components.forEach(component => {
                if (typeof component.destroy === 'function') {
                    component.destroy();
                }
            });
            this.components.clear();
        }
    }

    // === INITIALIZATION ===
    document.addEventListener('DOMContentLoaded', () => {
        const componentFactory = new ComponentFactory();
        componentFactory.init();

        // Expose globally
        window.ComponentFactory = componentFactory;
        window.Components = {
            Modal,
            ImageGallery,
            Tabs,
            Tooltip,
            Carousel,
            Accordion,
            Dropdown
        };

        console.log('🧩 Components initialized');
    });

})();