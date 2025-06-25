<!-- Navigation -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <img src="<?= asset('assets/images/mavi-gunes-sahaf-logo.png') ?>" alt="<?= getSetting('site_title') ?> Logo" class="logo">
            <div class="brand-text">
                <h2><?= getSetting('site_title') ?></h2>
                <span>Kitapların Güvenli Adresi</span>
            </div>
        </div>

        <div class="nav-links-container">
            <ul class="nav-links">
                <li><a href="<?= url() ?>" class="nav-link <?= $current_page == 'home' ? 'active' : '' ?>">🏠 Ana Sayfa</a></li>
                <li><a href="<?= url('services') ?>" class="nav-link <?= $current_page == 'services' ? 'active' : '' ?>">⚡ Hizmetler</a></li>
                <li><a href="<?= url('about') ?>" class="nav-link <?= $current_page == 'about' ? 'active' : '' ?>">👥 Hakkımızda</a></li>
                <li><a href="<?= url('testimonials') ?>" class="nav-link">💬 Yorumlar</a></li>
                <li><a href="<?= url('contact') ?>" class="nav-link <?= $current_page == 'contact' ? 'active' : '' ?>">📞 İletişim</a></li>
            </ul>

            <div class="nav-cta">
                <a href="tel:+90<?= getSetting('phone') ?>" class="btn btn-outline">
                    <i class="fas fa-phone"></i>
                    Hemen Ara
                </a>
                <a href="<?= getWhatsAppLink() ?>" class="btn btn-primary" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>
            </div>
        </div>

        <div class="mobile-menu-toggle" id="mobileMenuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>