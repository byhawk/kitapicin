<?php
// services.php - Hizmetlerimiz sayfası
?>

<!-- Services Hero Section -->
<section class="services-hero">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    
    <div class="container">
        <div class="services-hero-content">
            <div class="hero-badge reveal">
                <i class="fas fa-star"></i>
                <span>Profesyonel Hizmet</span>
            </div>
            
            <h1 class="hero-title reveal">
                <span class="title-main">Kapsamlı Kitap</span>
                <span class="title-highlight">Alım Hizmetleri</span>
            </h1>
            
            <p class="hero-description reveal">
                20 yıllık deneyimimizle her türlü kitabınızı <strong>en uygun fiyatlarla</strong> değerlendiriyoruz. 
                Akademik kitaplardan antika eserlere, romanlardan ders kitaplarına kadar geniş yelpazede hizmet.
            </p>

            <div class="services-stats reveal">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-books"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number counter"><?= getSetting('total_books') ?>+</span>
                        <span class="stat-label">Alınan Kitap</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number counter"><?= getSetting('happy_customers') ?>+</span>
                        <span class="stat-label">Mutlu Müşteri</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number counter">24</span>
                        <span class="stat-label">Saat İçinde Teklif</span>
                    </div>
                </div>
            </div>

            <div class="hero-cta reveal">
                <a href="<?= getWhatsAppLink() ?>" class="btn btn-primary btn-large" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>Ücretsiz Değerlendirme</span>
                    <small>WhatsApp'tan fotoğraf gönder</small>
                </a>
                <a href="tel:+90<?= getSetting('phone') ?>" class="btn btn-outline btn-large">
                    <i class="fas fa-phone"></i>
                    <span>Hemen Ara</span>
                    <small>Detaylı bilgi al</small>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Services Section -->
<section class="main-services">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-bookmark"></i>
                <span>Hizmet Kategorilerimiz</span>
            </div>
            <h2 class="section-title">
                <span>Hangi Kitapları</span>
                <span class="highlight">Alıyoruz?</span>
            </h2>
            <p class="section-description">
                Geniş hizmet yelpazemizle her türlü kitabınızı profesyonelce değerlendiriyoruz.
                Uzman ekibimizle adil fiyat garantisi!
            </p>
        </div>

        <div class="services-categories">
            <!-- Academic Books -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="category-badge">En Popüler</div>
                </div>
                <div class="category-content">
                    <h3>Akademik & Ders Kitapları</h3>
                    <p>Üniversite, lise ve ortaokul ders kitapları, akademik yayınlar, referans kaynakları</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Üniversite ders kitapları</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>TYT/AYT kaynak kitapları</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Akademik yayınlar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Tıp & Mühendislik kitapları</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">25₺ - 150₺</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Akademik kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Değerlendirme Yaptır</span>
                    </a>
                </div>
            </div>

            <!-- Literature -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3>Roman & Edebiyat</h3>
                    <p>Türk ve dünya edebiyatı, klasikler, çağdaş romanlar, şiir kitapları</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Türk edebiyatı klasikleri</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Dünya edebiyatı eserleri</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Çağdaş romanlar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Şiir & Hikaye kitapları</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">15₺ - 80₺</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Roman ve edebiyat kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Değerlendirme Yaptır</span>
                    </a>
                </div>
            </div>

            <!-- Antique & Rare -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-landmark"></i>
                    </div>
                    <div class="category-badge premium">Premium</div>
                </div>
                <div class="category-content">
                    <h3>Antika & Nadir Eserler</h3>
                    <p>Eski basım kitaplar, antika eserler, el yazması kitaplar, koleksiyon parçaları</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>1950 öncesi basımlar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>El yazması eserler</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Nadir koleksiyonlar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Uzman değerlendirme</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">100₺ - 5000₺+</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Antika kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Uzman Değerlendirme</span>
                    </a>
                </div>
            </div>

            <!-- Children's Books -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-child"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3>Çocuk & Gençlik</h3>
                    <p>Çocuk kitapları, gençlik romanları, eğitici kitaplar, resimli kitaplar</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>0-6 yaş resimli kitaplar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Çocuk klasikleri</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Gençlik romanları</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Eğitici oyun kitapları</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">10₺ - 60₺</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Çocuk kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Değerlendirme Yaptır</span>
                    </a>
                </div>
            </div>

            <!-- Professional Books -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3>Mesleki & Teknik</h3>
                    <p>Mesleki eğitim, teknik kitaplar, sağlık, hukuk, işletme kitapları</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Hukuk kitapları</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Tıp & Sağlık</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>İşletme & Yönetim</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Teknik referanslar</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">30₺ - 200₺</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Mesleki kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Değerlendirme Yaptır</span>
                    </a>
                </div>
            </div>

            <!-- Religious Books -->
            <div class="service-category reveal">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-mosque"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3>Dini & Tasavvuf</h3>
                    <p>Dini kitaplar, tasavvuf eserleri, tefsir, hadis, fıkıh kitapları</p>
                    
                    <div class="category-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Kuran-ı Kerim tefsirleri</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Hadis-i şerif kitapları</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Tasavvuf eserleri</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>İslami literatür</span>
                        </div>
                    </div>
                    
                    <div class="price-range">
                        <span class="price-label">Fiyat Aralığı:</span>
                        <span class="price-value">20₺ - 120₺</span>
                    </div>
                    
                    <a href="<?= getWhatsAppLink('Dini kitaplarımı değerlendirmek istiyorum.') ?>" class="category-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Değerlendirme Yaptır</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Process Section -->
<section class="service-process">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-cog"></i>
                <span>Nasıl Çalışıyoruz?</span>
            </div>
            <h2 class="section-title">
                <span>4 Adımda</span>
                <span class="highlight">Hızlı Süreç</span>
            </h2>
            <p class="section-description">
                Basit ve hızlı sürecimizle kitaplarınızı değerlendiriyoruz.
                Güvenilir ve şeffaf işlem garantisi!
            </p>
        </div>

        <div class="process-steps">
            <div class="process-step reveal">
                <div class="step-number">1</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h3>Fotoğraf Gönderimi</h3>
                    <p>WhatsApp üzerinden kitaplarınızın fotoğraflarını gönderin. Kitap kapağı, sayfa durumu ve genel görünüm fotoğrafları yeterli.</p>
                    <div class="step-features">
                        <span>Ücretsiz değerlendirme</span>
                        <span>24 saat içinde yanıt</span>
                        <span>Detaylı analiz</span>
                    </div>
                </div>
            </div>

            <div class="process-step reveal">
                <div class="step-number">2</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Fiyat Teklifi</h3>
                    <p>Uzman ekibimiz kitaplarınızı değerlendirerek size en uygun fiyat teklifini sunar. Şeffaf ve adil fiyatlandırma.</p>
                    <div class="step-features">
                        <span>Piyasa değeri analizi</span>
                        <span>Durum değerlendirmesi</span>
                        <span>Rekabetçi fiyat</span>
                    </div>
                </div>
            </div>

            <div class="process-step reveal">
                <div class="step-number">3</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Anlaşma & Teslim</h3>
                    <p>Fiyatı kabul ettiğinizde randevu alarak adresinizden kitapları teslim alıyoruz. Ücretsiz kargo hizmeti.</p>
                    <div class="step-features">
                        <span>Adrese teslim alma</span>
                        <span>Ücretsiz kargo</span>
                        <span>Esnek randevu</span>
                    </div>
                </div>
            </div>

            <div class="process-step reveal">
                <div class="step-number">4</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Ödeme</h3>
                    <p>Kitaplarınızı teslim alır almaz anlaştığımız tutarı nakit veya havale olarak ödüyoruz. Hızlı ve güvenli ödeme.</p>
                    <div class="step-features">
                        <span>Anında ödeme</span>
                        <span>Nakit/Havale</span>
                        <span>Güvenli işlem</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guarantees Section -->
<section class="service-guarantees">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Güvencelerimiz</span>
            </div>
            <h2 class="section-title">
                <span>Neden</span>
                <span class="highlight">Bizi Seçmelisiniz?</span>
            </h2>
        </div>

        <div class="guarantees-grid">
            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3><?= getSetting('experience_years') ?>+ Yıl Deneyim</h3>
                <p>Sahaf sektöründe <?= getSetting('experience_years') ?> yılı aşkın deneyimimizle güvenilir hizmet veriyoruz.</p>
            </div>

            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <h3>En İyi Fiyat Garantisi</h3>
                <p>Piyasadaki en iyi fiyatları sunuyoruz. Daha iyi teklif bulursanız, farkını kapatırız.</p>
            </div>

            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>Ücretsiz Kargo</h3>
                <p>Ankara içi tüm ilçelere ücretsiz kargo hizmeti sunuyoruz.</p>
            </div>

            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Hızlı Değerlendirme</h3>
                <p>24 saat içinde kitaplarınızı değerlendirip size fiyat teklifi sunuyoruz.</p>
            </div>

            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3>Gizlilik Garantisi</h3>
                <p>Kişisel bilgileriniz tamamen güvende. 3. şahıslarla asla paylaşılmaz.</p>
            </div>

            <div class="guarantee-card reveal">
                <div class="guarantee-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3>İade Garantisi</h3>
                <p>Fiyattan memnun kalmazsanız, kitaplarınızı geri alabilirsiniz.</p>
            </div>
        </div>
    </div>
</section>

<!-- Special Services Section -->
<section class="special-services">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-star"></i>
                <span>Özel Hizmetler</span>
            </div>
            <h2 class="section-title">
                <span>Ek</span>
                <span class="highlight">Hizmetlerimiz</span>
            </h2>
        </div>

        <div class="special-services-grid">
            <div class="special-service reveal">
                <div class="service-image">
                    <i class="fas fa-home"></i>
                </div>
                <div class="service-content">
                    <h3>Ev & Ofis Temizliği</h3>
                    <p>Evinizdeki veya ofisinizdekilerin tamamını toplu olarak alıyoruz. Büyük koleksiyonlar için özel fiyat avantajları.</p>
                    <ul>
                        <li>Ücretsiz değerlendirme</li>
                        <li>Toplu alım indirimi</li>
                        <li>Paketleme hizmeti</li>
                        <li>Aynı gün ödeme</li>
                    </ul>
                    <a href="<?= getWhatsAppLink('Toplu kitap alımı hakkında bilgi almak istiyorum.') ?>" class="service-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Bilgi Al</span>
                    </a>
                </div>
            </div>

            <div class="special-service reveal">
                <div class="service-image">
                    <i class="fas fa-search"></i>
                </div>
                <div class="service-content">
                    <h3>Nadir Kitap Arama</h3>
                    <p>Aradığınız belirli kitapları sizin için buluyoruz. Geniş ağımızla nadir eserlere ulaşım sağlıyoruz.</p>
                    <ul>
                        <li>Profesyonel araştırma</li>
                        <li>Antika eser bulma</li>
                        <li>İlk baskı arama</li>
                        <li>Koleksiyoncu desteği</li>
                    </ul>
                    <a href="<?= getWhatsAppLink('Nadir kitap arama hizmeti hakkında bilgi almak istiyorum.') ?>" class="service-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Talep Et</span>
                    </a>
                </div>
            </div>

            <div class="special-service reveal">
                <div class="service-image">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="service-content">
                    <h3>Koleksiyon Değerlendirme</h3>
                    <p>Miras kalan veya satılacak büyük koleksiyonları uzman ekibimizle değerlendiriyoruz.</p>
                    <ul>
                        <li>Uzman değerlendirme</li>
                        <li>Kataloglama hizmeti</li>
                        <li>Sigorta değerlendirmesi</li>
                        <li>Müzayede danışmanlığı</li>
                    </ul>
                    <a href="tel:+90<?= getSetting('phone') ?>" class="service-btn">
                        <i class="fas fa-phone"></i>
                        <span>Arayın</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="services-cta-final">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
    </div>
    
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2>Kitaplarınızın Değerini Öğrenin</h2>
                <p>WhatsApp'tan fotoğraf gönderin, ücretsiz değerlendirme yaptıralım! <?= getSetting('experience_years') ?> yıllık deneyimimizle en uygun fiyatı alın.</p>
                
                <div class="cta-features">
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>Ücretsiz Değerlendirme</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>24 Saat İçinde Yanıt</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>En İyi Fiyat Garantisi</span>
                    </div>
                </div>
            </div>
            
            <div class="cta-actions">
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
    </div>
</section>