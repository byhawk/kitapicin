<section id="hero" class="hero">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    <span>Ankara'nın #1 Sahafı</span>
                </div>
                
                <h1 class="hero-title">
                    <span class="title-main"><?= getSetting('hero_title') ?></span>
                </h1>
                
                <p class="hero-description">
                    <?= getSetting('hero_description') ?>
                </p>

                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Aynı Gün Alım</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>En İyi Fiyat Garantisi</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-home"></i>
                        <span>Adresinizden Alım</span>
                    </div>
                </div>

                <div class="hero-cta">
                    <a href="<?= getWhatsAppLink() ?>" class="btn btn-primary btn-large pulse-animation" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp'tan Fotoğraf Gönder</span>
                        <small>Hemen teklif al!</small>
                    </a>
                    <a href="tel:+90<?= getSetting('phone') ?>" class="btn btn-outline btn-large">
                        <i class="fas fa-phone"></i>
                        <span><?= formatPhone(getSetting('phone')) ?></span>
                        <small>Hemen arayın</small>
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-image-container">
                    <img src="assets/images/kitap-yigini-hero.jpg" alt="Kitap Koleksiyonu" class="hero-image">
                    <div class="image-overlay">
                        <div class="stats-card">
                            <div class="stat">
                                <span class="number counter"><?= getSetting('total_books') ?>+</span>
                                <span class="label">Alınan Kitap</span>
                            </div>
                            <div class="stat">
                                <span class="number counter"><?= getSetting('experience_years') ?></span>
                                <span class="label">Yıl Deneyim</span>
                            </div>
                            <div class="stat">
                                <span class="number counter"><?= getSetting('happy_customers') ?>+</span>
                                <span class="label">Mutlu Müşteri</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-star"></i>
                <span>Hizmetlerimiz</span>
            </div>
            <h2 class="section-title">
                <span>Hangi Kitapları</span>
                <span class="highlight">Alıyoruz?</span>
            </h2>
            <p class="section-description">
                Her türlü kitabınızı en uygun fiyatlarla değerlendiriyoruz. 
                Uzman ekibimizle adil ve hızlı işlem garantisi!
            </p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Roman & Edebiyat</h3>
                <p>Türk ve dünya edebiyatı, klasikler, çağdaş romanlar ve hikaye kitapları</p>
                <div class="service-price">15₺'den başlayan fiyatlar</div>
            </div>

            <div class="service-card featured">
                <div class="featured-badge">En Popüler</div>
                <div class="service-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Akademik & Ders Kitapları</h3>
                <p>Üniversite, lise ders kitapları, akademik yayınlar ve referans kaynakları</p>
                <div class="service-price">25₺'den başlayan fiyatlar</div>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-landmark"></i>
                </div>
                <h3>Antika & Nadir Eserler</h3>
                <p>Eski basım kitaplar, antika eserler, el yazması kitaplar ve koleksiyon parçaları</p>
                <div class="service-price">100₺'den başlayan fiyatlar</div>
            </div>
        </div>

        <div class="services-cta">
            <div class="cta-content">
                <h3>Kitaplarınızın Değerini Merak Ediyor musunuz?</h3>
                <p>WhatsApp'tan fotoğraf gönderin, ücretsiz değerlendirme yaptıralım!</p>
            </div>
            <a href="<?= getWhatsAppLink() ?>" class="btn btn-primary btn-large" target="_blank">
                <i class="fab fa-whatsapp"></i>
                Hemen Değerlendirme Yaptır
            </a>
        </div>
    </div>
</section>
