
<!-- Hero Section -->
<section class="contact-hero">
    <div class="hero-bg">
        <div class="gradient-overlay"></div>
    </div>
    
    <div class="container">
        <div class="contact-hero-content">
            <div class="hero-badge reveal">
                <i class="fas fa-headset"></i>
                <span>7/24 Hizmetinizdeyiz</span>
            </div>
            
            <h1 class="hero-title reveal">
                <span class="title-main">Bizimle</span>
                <span class="title-highlight">İletişime Geçin</span>
            </h1>
            
            <p class="hero-description reveal">
                Kitaplarınız için <strong>hemen değerlendirme</strong> yaptırın! 
                WhatsApp'tan fotoğraf gönderin, aynı gün içinde teklifinizi alın.
            </p>

            <div class="contact-methods-preview reveal">
                <a href="<?= getWhatsAppLink() ?>" class="method-preview primary" target="_blank">
                    <div class="method-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="method-info">
                        <h3>WhatsApp</h3>
                        <p>Fotoğraf gönder, teklif al</p>
                    </div>
                    <div class="method-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>

                <a href="tel:+90<?= getSetting('phone') ?>" class="method-preview">
                    <div class="method-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="method-info">
                        <h3>Telefon</h3>
                        <p><?= formatPhone(getSetting('phone')) ?></p>
                    </div>
                    <div class="method-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="main-contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-methods">
                <div class="section-header">
                    <h2 class="section-title">
                        <span>Size En Uygun</span>
                        <span class="highlight">Yöntemi Seçin</span>
                    </h2>
                </div>

                <div class="methods-list">
                    <div class="contact-method featured reveal">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="method-info">
                                <h3>WhatsApp ile Hızlı Değerlendirme</h3>
                                <p class="method-subtitle">En hızlı ve kolay yöntem</p>
                            </div>
                            <div class="featured-badge">
                                <span>Önerilen</span>
                            </div>
                        </div>
                        <div class="method-content">
                            <a href="<?= getWhatsAppLink() ?>" class="method-button primary" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp'ta Mesaj Gönder</span>
                            </a>
                            <div class="method-number"><?= formatPhone(getSetting('phone')) ?></div>
                        </div>
                    </div>

                    <div class="contact-method reveal">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="method-info">
                                <h3>Telefon ile Görüşme</h3>
                                <p class="method-subtitle">Direkt konuşarak bilgi alın</p>
                            </div>
                        </div>
                        <div class="method-content">
                            <a href="tel:+90<?= getSetting('phone') ?>" class="method-button">
                                <i class="fas fa-phone"></i>
                                <span>Hemen Ara</span>
                            </a>
                            <div class="method-number"><?= formatPhone(getSetting('phone')) ?></div>
                            <div class="method-hours">
                                <i class="fas fa-clock"></i>
                                <span><?= getSetting('working_hours') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-section">
                <div class="form-header">
                    <h3>Hızlı İletişim Formu</h3>
                    <p>Sorularınızı buradan da gönderebilirsiniz</p>
                </div>

                <form id="contactForm" action="api/contact_form.php" method="POST" class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Ad Soyad *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon Numarası</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-posta Adresi *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Konu</label>
                        <select id="subject" name="subject">
                            <option value="">Konu seçin</option>
                            <option value="kitap-degerlendirme">Kitap Değerlendirmesi</option>
                            <option value="antika-kitap">Antika Kitap Sorgusu</option>
                            <option value="toplu-alim">Toplu Kitap Alımı</option>
                            <option value="fiyat-bilgisi">Fiyat Bilgisi</option>
                            <option value="genel-bilgi">Genel Bilgi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Mesajınız *</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Mesajı Gönder</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
