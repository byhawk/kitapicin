<?php
// about.php - Hakkımızda sayfası
?>

<!-- About Hero Section -->
<section class="about-hero">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    
    <div class="container">
        <div class="about-hero-content">
            <div class="hero-text">
                <div class="hero-badge reveal">
                    <i class="fas fa-heart"></i>
                    <span><?= getSetting('experience_years') ?>+ Yıl Deneyim</span>
                </div>
                
                <h1 class="hero-title reveal">
                    <span class="title-main">Ankara'nın</span>
                    <span class="title-highlight">Güvenilir Sahafı</span>
                </h1>
                
                <p class="hero-description reveal">
                    2003 yılından beri Ankara'da sahaf sektöründe faaliyet göstermekteyiz. 
                    <strong><?= getSetting('total_books') ?>'den fazla kitabı</strong> değerlendirip, <strong><?= getSetting('happy_customers') ?>'den fazla müşterimize</strong> hizmet sunduk.
                </p>

                <div class="hero-stats reveal">
                    <div class="stat-item">
                        <span class="stat-number counter"><?= getSetting('experience_years') ?></span>
                        <span class="stat-label">Yıl Deneyim</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number counter"><?= getSetting('total_books') ?></span>
                        <span class="stat-label">Alınan Kitap</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number counter"><?= getSetting('happy_customers') ?></span>
                        <span class="stat-label">Mutlu Müşteri</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number counter">98</span>
                        <span class="stat-label">% Memnuniyet</span>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <div class="image-container">
                    <img src="assets/images/about-hero.jpg" alt="Mavi Güneş Sahaf İçi" class="main-image">
                    <div class="image-overlay">
                        <div class="overlay-content">
                            <h3>Mavi Güneş Sahaf</h3>
                            <p>Geleneksel sahafçılık modern yaklaşımla</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="our-story">
    <div class="container">
        <div class="story-content">
            <div class="story-text">
                <div class="section-badge">
                    <i class="fas fa-book-reader"></i>
                    <span>Hikayemiz</span>
                </div>
                
                <h2 class="section-title">
                    <span><?= getSetting('experience_years') ?> Yıllık</span>
                    <span class="highlight">Sahafçılık Yolculuğu</span>
                </h2>
                
                <div class="story-timeline">
                    <div class="timeline-item reveal">
                        <div class="timeline-year">2003</div>
                        <div class="timeline-content">
                            <h3>Başlangıç</h3>
                            <p>Ankara Kızılay'da küçük bir dükkanla sahafçılık serüvenimiz başladı. İlk günden itibaren müşteri memnuniyeti odaklı çalışma prensibimizi belirledik.</p>
                        </div>
                    </div>

                    <div class="timeline-item reveal">
                        <div class="timeline-year">2008</div>
                        <div class="timeline-content">
                            <h3>Büyüme</h3>
                            <p>Müşteri tabanımızın genişlemesiyle birlikte hizmet alanımızı artırdık. Akademik kitaplar ve antika eserler konusunda uzmanlaştık.</p>
                        </div>
                    </div>

                    <div class="timeline-item reveal">
                        <div class="timeline-year">2015</div>
                        <div class="timeline-content">
                            <h3>Dijitalleşme</h3>
                            <p>Online değerlendirme sistemimizi kurarak müşterilerimizin WhatsApp üzerinden hizmet alabilmesini sağladık.</p>
                        </div>
                    </div>

                    <div class="timeline-item reveal">
                        <div class="timeline-year">2024</div>
                        <div class="timeline-content">
                            <h3>Modern Sahaf</h3>
                            <p>Günümüzde Ankara'nın en güvenilir sahafı olarak, geleneksel değerleri modern yaklaşımla birleştiren hizmet anlayışımızla faaliyetlerimizi sürdürüyoruz.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="story-visual">
                <div class="visual-grid">
                    <div class="visual-item reveal">
                        <img src="assets/images/story-1.jpg" alt="2003 - İlk Dükkan">
                        <div class="visual-overlay">
                            <h4>2003 - İlk Dükkan</h4>
                            <p>Küçük ama büyük hayallerle</p>
                        </div>
                    </div>
                    <div class="visual-item reveal">
                        <img src="assets/images/story-2.jpg" alt="2010 - Büyüme">
                        <div class="visual-overlay">
                            <h4>2010 - Büyüme</h4>
                            <p>Genişleyen hizmet alanı</p>
                        </div>
                    </div>
                    <div class="visual-item reveal">
                        <img src="assets/images/story-3.jpg" alt="2024 - Günümüz">
                        <div class="visual-overlay">
                            <h4>2024 - Günümüz</h4>
                            <p>Modern sahaf yaklaşımı</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-compass"></i>
                <span>Misyon & Vizyon</span>
            </div>
            <h2 class="section-title">
                <span>Değerlerimiz &</span>
                <span class="highlight">Hedeflerimiz</span>
            </h2>
        </div>

        <div class="mission-vision-grid">
            <div class="mission-card reveal">
                <div class="card-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Misyonumuz</h3>
                <p>Kitaplarınızın gerçek değerini takdir eden, güvenilir ve şeffaf hizmet anlayışıyla Ankara'nın en çok tercih edilen sahafı olmak. Her kitabın bir hikayesi vardır ve biz bu hikayelere saygı duyarak onları doğru ellere ulaştırmaya çalışıyoruz.</p>
                <div class="mission-features">
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Güvenilir hizmet</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Şeffaf işlemler</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Adil fiyatlandırma</span>
                    </div>
                </div>
            </div>

            <div class="vision-card reveal">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Vizyonumuz</h3>
                <p>Türkiye'nin sahaf sektöründe örnek gösterilen, teknoloji ile geleneksel değerleri harmanlayan, müşteri memnuniyetini her şeyin üstünde tutan bir işletme olmak. Gelecek nesillere kitap sevgisini aktaran köprü görevi üstlenmek.</p>
                <div class="vision-features">
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Teknoloji entegrasyonu</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Sürdürülebilir büyüme</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Kültürel sorumluluk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="our-team">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-users"></i>
                <span>Ekibimiz</span>
            </div>
            <h2 class="section-title">
                <span>Uzman</span>
                <span class="highlight">Ekibimiz</span>
            </h2>
            <p class="section-description">
                Alanında uzman ekibimizle kitaplarınızı en doğru şekilde değerlendiriyoruz.
            </p>
        </div>

        <div class="team-grid">
            <div class="team-member reveal">
                <div class="member-image">
                    <img src="assets/images/team-owner.jpg" alt="Mehmet Bey - Kurucu">
                    <div class="member-overlay">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3>Mehmet Bey</h3>
                    <span class="member-role">Kurucu & Genel Koordinatör</span>
                    <p><?= getSetting('experience_years') ?> yıllık sahaf deneyimi. Antika kitaplar ve nadir eserler konusunda uzman.</p>
                    <div class="member-expertise">
                        <span>Antika Eserler</span>
                        <span>Kitap Değerlendirme</span>
                        <span>Müşteri İlişkileri</span>
                    </div>
                </div>
            </div>

            <div class="team-member reveal">
                <div class="member-image">
                    <img src="assets/images/team-academic.jpg" alt="Dr. Ayşe Hanım - Akademik Uzman">
                    <div class="member-overlay">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3>Dr. Ayşe Hanım</h3>
                    <span class="member-role">Akademik Kitap Uzmanı</span>
                    <p>Üniversite ders kitapları ve akademik yayınlar konusunda 15 yıllık deneyim.</p>
                    <div class="member-expertise">
                        <span>Akademik Yayınlar</span>
                        <span>Ders Kitapları</span>
                        <span>Referans Kaynakları</span>
                    </div>
                </div>
            </div>

            <div class="team-member reveal">
                <div class="member-image">
                    <img src="assets/images/team-literature.jpg" alt="Ali Bey - Edebiyat Uzmanı">
                    <div class="member-overlay">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3>Ali Bey</h3>
                    <span class="member-role">Edebiyat & Roman Uzmanı</span>
                    <p>Türk ve dünya edebiyatı, klasik eserler konusunda derin bilgi ve deneyim.</p>
                    <div class="member-expertise">
                        <span>Türk Edebiyatı</span>
                        <span>Dünya Klasikleri</span>
                        <span>Modern Roman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-star"></i>
                <span>Neden Biz?</span>
            </div>
            <h2 class="section-title">
                <span>Bizi Farklı Kılan</span>
                <span class="highlight">Özellikler</span>
            </h2>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h3>Uzman Değerlendirme</h3>
                <p>Her kategoride uzman ekibimizle kitaplarınızı en doğru şekilde değerlendiriyoruz. Piyasa değerini tam olarak belirliyoruz.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Hızlı İşlem</h3>
                <p>24 saat içinde değerlendirme, anlaştığımız gün teslim alma ve anında ödeme ile sürecin tamamını hızlandırıyoruz.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-shield-check"></i>
                </div>
                <h3>Güvenli Alışveriş</h3>
                <p>Tüm işlemlerimizde şeffaflık ilkesi. Gizlilik sözleşmesi ile bilgilerinizin güvenliğini garanti ediyoruz.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3>Adrese Teslim</h3>
                <p>Ankara içi tüm ilçelere ücretsiz teslim alma hizmeti. Siz evinizdeyken kitaplarınızı teslim alıyoruz.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Müşteri Odaklı</h3>
                <p>WhatsApp, telefon ve online kanallarla 7/24 iletişim. Sorularınızı anında yanıtlıyoruz.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3>Çevre Dostu</h3>
                <p>Kitapların yeniden değerlendirilmesine katkı sağlayarak çevresel sürdürülebilirliği destekliyoruz.</p>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="customer-reviews">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
    </div>
    
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-quote-left"></i>
                <span>Müşteri Yorumları</span>
            </div>
            <h2 class="section-title">
                <span>Müşterilerimiz</span>
                <span class="highlight">Ne Diyor?</span>
            </h2>
        </div>

        <div class="reviews-grid">
            <div class="review-card reveal">
                <div class="review-header">
                    <div class="customer-avatar">
                        <img src="assets/images/customer-1.jpg" alt="Ahmet Bey">
                    </div>
                    <div class="customer-info">
                        <h4>Ahmet Bey</h4>
                        <span>Üniversite Öğrencisi</span>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <p>"Mühendislik ders kitaplarımı çok iyi fiyata aldılar. WhatsApp'tan fotoğraf gönderdim, ertesi gün teklif geldi. Çok memnun kaldım."</p>
                </div>
                <div class="review-footer">
                    <span class="review-date">2 hafta önce</span>
                    <span class="sale-amount">1,250₺</span>
                </div>
            </div>

            <div class="review-card featured reveal">
                <div class="review-header">
                    <div class="customer-avatar">
                        <img src="assets/images/customer-2.jpg" alt="Fatma Hanım">
                    </div>
                    <div class="customer-info">
                        <h4>Fatma Hanım</h4>
                        <span>Öğretmen</span>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <p>"Babamdan kalma antika kitapları değerlendirdiler. O kadar hassas ve bilgili yaklaştılar ki... Gerçekten güvenilir bir yer."</p>
                </div>
                <div class="review-footer">
                    <span class="review-date">1 ay önce</span>
                    <span class="sale-amount">3,800₺</span>
                </div>
            </div>

            <div class="review-card reveal">
                <div class="review-header">
                    <div class="customer-avatar">
                        <img src="assets/images/customer-3.jpg" alt="Mehmet Bey">
                    </div>
                    <div class="customer-info">
                        <h4>Mehmet Bey</h4>
                        <span>Doktor</span>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    <p>"Tıp fakültesi kitaplarımı toplu olarak aldılar. Evime kadar gelip teslim aldılar. Hem pratik hem güvenilir bir hizmet."</p>
                </div>
                <div class="review-footer">
                    <span class="review-date">3 hafta önce</span>
                    <span class="sale-amount">2,100₺</span>
                </div>
            </div>
        </div>

        <div class="reviews-summary">
            <div class="summary-stats">
                <div class="summary-item">
                    <span class="summary-number">4.9</span>
                    <span class="summary-label">Ortalama Puan</span>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="summary-item">
                    <span class="summary-number">500+</span>
                    <span class="summary-label">Müşteri Yorumu</span>
                </div>
                <div class="summary-item">
                    <span class="summary-number">98%</span>
                    <span class="summary-label">Memnuniyet Oranı</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="about-cta">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2>Sizinle Tanışmaktan Mutluluk Duyarız</h2>
                <p>
                    <?= getSetting('experience_years') ?> yıllık deneyimimizle kitaplarınızı değerlendirmeye hazırız. 
                    Güvenilir hizmet anlayışımızla yanınızdayız.
                </p>
                
                <div class="cta-features">
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>Ücretsiz değerlendirme</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>Uzman görüşü</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>Hızlı işlem</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check"></i>
                        <span>Güvenli ödeme</span>
                    </div>
                </div>
            </div>
            
            <div class="cta-actions">
                <a href="<?= getWhatsAppLink() ?>" class="btn btn-primary btn-large" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp ile Başla</span>
                    <small>Hemen değerlendirme yaptır</small>
                </a>
                <a href="/contact" class="btn btn-outline btn-large">
                    <i class="fas fa-envelope"></i>
                    <span>İletişime Geç</span>
                    <small>Detaylı bilgi al</small>
                </a>
            </div>
        </div>
    </div>
</section>