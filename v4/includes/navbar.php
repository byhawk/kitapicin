<?php
// Mevcut sayfa tespiti
$current_page = $current_page ?? 'home';
$current_url = $_SERVER['REQUEST_URI'] ?? '/';
?>

<!-- Enhanced Navigation -->
<nav class="navbar" id="navbar" role="navigation" aria-label="Ana navigasyon">
    <div class="nav-container">
        <!-- Brand Section -->
        <a href="<?= url() ?>" class="nav-brand" aria-label="Ana sayfaya git">
            <div class="brand-logo">
                <img src="<?= asset('assets/images/mavi-gunes-sahaf-logo.png') ?>" 
                     alt="<?= getSetting('site_title') ?> Logo" 
                     class="logo"
                     loading="eager">

            </div>
        </a>

        <!-- Navigation Links Container -->
        <div class="nav-links-container" id="navLinksContainer" role="menubar">
            <!-- Main Navigation -->
            <ul class="nav-links" role="menu">
                <li role="none">
                    <a href="<?= url() ?>" 
                       class="nav-link <?= ($current_page == 'home' || $current_url == '/') ? 'active' : '' ?>"
                       role="menuitem"
                       aria-current="<?= ($current_page == 'home' || $current_url == '/') ? 'page' : 'false' ?>">
                        <i class="fas fa-home" aria-hidden="true"></i>
                        <span>Ana Sayfa</span>
                    </a>
                </li>
                <li role="none">
                    <a href="<?= url('services') ?>" 
                       class="nav-link <?= $current_page == 'services' ? 'active' : '' ?>"
                       role="menuitem"
                       aria-current="<?= $current_page == 'services' ? 'page' : 'false' ?>">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        <span>Hizmetlerimiz</span>
                    </a>
                </li>
                <li role="none">
                    <a href="<?= url('about') ?>" 
                       class="nav-link <?= $current_page == 'about' ? 'active' : '' ?>"
                       role="menuitem"
                       aria-current="<?= $current_page == 'about' ? 'page' : 'false' ?>">
                        <i class="fas fa-users" aria-hidden="true"></i>
                        <span>Hakkımızda</span>
                    </a>
                </li>
                <li role="none">
                    <a href="<?= url('testimonials') ?>" 
                       class="nav-link <?= $current_page == 'testimonials' ? 'active' : '' ?>"
                       role="menuitem"
                       aria-current="<?= $current_page == 'testimonials' ? 'page' : 'false' ?>">
                        <i class="fas fa-star" aria-hidden="true"></i>
                        <span>Yorumlar</span>
                    </a>
                </li>
                <li role="none">
                    <a href="<?= url('contact') ?>" 
                       class="nav-link <?= $current_page == 'contact' ? 'active' : '' ?>"
                       role="menuitem"
                       aria-current="<?= $current_page == 'contact' ? 'page' : 'false' ?>">
                        <i class="fas fa-phone" aria-hidden="true"></i>
                        <span>İletişim</span>
                    </a>
                </li>
            </ul>

            <!-- CTA Buttons -->
            <div class="nav-cta">
                <a href="<?= getWhatsAppLink('Merhaba! Kitaplarım için değerlendirme yaptırmak istiyorum.') ?>" 
                   class="btn btn-primary btn-whatsapp" 
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="WhatsApp ile iletişime geç">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    <span class="btn-text">WhatsApp</span>
                    <div class="pulse-ring"></div>
                </a>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" 
                id="mobileMenuToggle"
                type="button"
                aria-label="Mobil menüyü aç/kapat"
                aria-expanded="false"
                aria-controls="navLinksContainer">
            <span class="hamburger-line" aria-hidden="true"></span>
            <span class="hamburger-line" aria-hidden="true"></span>
            <span class="hamburger-line" aria-hidden="true"></span>
            <span class="menu-text">Menü</span>
        </button>
    </div>

    <!-- Progress Bar -->
    <div class="scroll-progress" id="scrollProgress">
        <div class="scroll-progress-bar"></div>
    </div>

    <!-- Status Indicator -->
    
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <div class="mobile-menu-content">
        <div class="mobile-menu-header">
            <div class="mobile-brand">
                <img src="<?= asset('assets/images/mavi-gunes-sahaf-logo.png') ?>" 
                     alt="<?= getSetting('site_title') ?>" 
                     class="mobile-logo">
                <div class="mobile-brand-text">
                    <h3><?= getSetting('site_title') ?></h3>
                    <span>Kitapların Güvenli Adresi</span>
                </div>
            </div>
            <button class="mobile-close" id="mobileClose" aria-label="Menüyü kapat">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-menu-body">
            <ul class="mobile-nav-links">
                <li>
                    <a href="<?= url() ?>" 
                       class="mobile-nav-link <?= ($current_page == 'home' || $current_url == '/') ? 'active' : '' ?>">
                        <div class="mobile-link-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="mobile-link-content">
                            <span class="link-title">Ana Sayfa</span>
                            <span class="link-subtitle">Anasayfaya dön</span>
                        </div>
                        <i class="fas fa-chevron-right mobile-link-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= url('services') ?>" 
                       class="mobile-nav-link <?= $current_page == 'services' ? 'active' : '' ?>">
                        <div class="mobile-link-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="mobile-link-content">
                            <span class="link-title">Hizmetlerimiz</span>
                            <span class="link-subtitle">Kitap alım hizmetleri</span>
                        </div>
                        <i class="fas fa-chevron-right mobile-link-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= url('about') ?>" 
                       class="mobile-nav-link <?= $current_page == 'about' ? 'active' : '' ?>">
                        <div class="mobile-link-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="mobile-link-content">
                            <span class="link-title">Hakkımızda</span>
                            <span class="link-subtitle">Firmamız hakkında</span>
                        </div>
                        <i class="fas fa-chevron-right mobile-link-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= url('testimonials') ?>" 
                       class="mobile-nav-link <?= $current_page == 'testimonials' ? 'active' : '' ?>">
                        <div class="mobile-link-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="mobile-link-content">
                            <span class="link-title">Yorumlar</span>
                            <span class="link-subtitle">Müşteri deneyimleri</span>
                        </div>
                        <i class="fas fa-chevron-right mobile-link-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= url('contact') ?>" 
                       class="mobile-nav-link <?= $current_page == 'contact' ? 'active' : '' ?>">
                        <div class="mobile-link-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="mobile-link-content">
                            <span class="link-title">İletişim</span>
                            <span class="link-subtitle">Bizimle iletişime geçin</span>
                        </div>
                        <i class="fas fa-chevron-right mobile-link-arrow"></i>
                    </a>
                </li>
            </ul>

            <div class="mobile-cta-section">
                <h4>Hızlı İletişim</h4>
                <div class="mobile-cta-buttons">
                    <a href="tel:+90<?= str_replace(' ', '', getSetting('phone')) ?>" 
                       class="mobile-cta-btn call">
                        <div class="cta-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="cta-content">
                            <span class="cta-title">Hemen Ara</span>
                            <span class="cta-subtitle"><?= formatPhone(getSetting('phone')) ?></span>
                        </div>
                    </a>
                    <a href="<?= getWhatsAppLink('Merhaba! Kitaplarım için değerlendirme yaptırmak istiyorum.') ?>" 
                       class="mobile-cta-btn whatsapp" 
                       target="_blank">
                        <div class="cta-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="cta-content">
                            <span class="cta-title">WhatsApp</span>
                            <span class="cta-subtitle">Fotoğraf gönder</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mobile-info-section">
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span><?= getSetting('working_hours') ?></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?= getSetting('address') ?></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-award"></i>
                    <span><?= getSetting('experience_years') ?> yıllık deneyim</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar için Critical CSS -->
<style>
/* Critical CSS - Loading sırasında layout shift önleme */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    transition: all 0.3s ease;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
}

.logo {
    height: 50px;
    width: auto;
}

.nav-links-container {
    display: flex;
    align-items: center;
    gap: 40px;
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 30px;
    margin: 0;
}

.mobile-menu-toggle,
.mobile-menu-overlay {
    display: none;
}

@media (max-width: 768px) {
    .nav-links-container {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: flex;
        flex-direction: column;
        gap: 4px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
    }
    
    .hamburger-line {
        width: 25px;
        height: 3px;
        background: #2D6B78;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
}

/* Body offset for fixed navbar */
body {
    padding-top: 80px;
}
</style>

<!-- Enhanced Schema.org Markup -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SiteNavigationElement",
    "name": "Ana Navigasyon",
    "url": "<?= url() ?>",
    "hasPart": [
        {
            "@type": "SiteNavigationElement",
            "name": "Ana Sayfa",
            "url": "<?= url() ?>",
            "description": "Mavi Güneş Sahaf ana sayfası"
        },
        {
            "@type": "SiteNavigationElement", 
            "name": "Hizmetlerimiz",
            "url": "<?= url('services') ?>",
            "description": "Kitap alım satım hizmetlerimiz"
        },
        {
            "@type": "SiteNavigationElement",
            "name": "Hakkımızda", 
            "url": "<?= url('about') ?>",
            "description": "Firmamız ve deneyimimiz hakkında"
        },
        {
            "@type": "SiteNavigationElement",
            "name": "Müşteri Yorumları",
            "url": "<?= url('testimonials') ?>",
            "description": "Müşterilerimizin deneyimleri"
        },
        {
            "@type": "SiteNavigationElement",
            "name": "İletişim",
            "url": "<?= url('contact') ?>",
            "description": "Bizimle iletişime geçin"
        }
    ]
}
</script>