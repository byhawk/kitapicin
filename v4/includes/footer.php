<!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <img src="assets/images/mavi-gunes-sahaf-logo.png" alt="<?= getSetting('site_title') ?>" class="footer-logo">
                    <h3><?= getSetting('site_title') ?></h3>
                    <p><?= getSetting('experience_years') ?> yıldır Ankara'nın en güvenilir sahafı. Kitaplarınızı en iyi fiyatla alıyor, çevreye katkıda bulunuyoruz.</p>
                    <div class="social-links">
                        <a href="<?= getSetting('facebook_url') ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="<?= getSetting('instagram_url') ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="<?= getSetting('twitter_url') ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="<?= getWhatsAppLink() ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-links">
                    <h4>Hızlı Linkler</h4>
                    <ul>
                        <li><a href="/">Ana Sayfa</a></li>
                        <li><a href="/services">Hizmetlerimiz</a></li>
                        <li><a href="/about">Hakkımızda</a></li>
                        <li><a href="/testimonials">Yorumlar</a></li>
                        <li><a href="/contact">İletişim</a></li>
                    </ul>
                </div>

                <div class="footer-services">
                    <h4>Hizmetlerimiz</h4>
                    <ul>
                        <li>Roman & Edebiyat Alımı</li>
                        <li>Akademik Kitap Alımı</li>
                        <li>Antika Eser Değerlendirmesi</li>
                        <li>Dergi & Çizgi Roman Alımı</li>
                        <li>Aynı Gün Adresinizden Alım</li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>İletişim Bilgileri</h4>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+90<?= getSetting('phone') ?>"><?= formatPhone(getSetting('phone')) ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <a href="<?= getWhatsAppLink() ?>" target="_blank">WhatsApp</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:<?= getSetting('email') ?>"><?= getSetting('email') ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= getSetting('address') ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span><?= getSetting('working_hours') ?></span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; <?= date('Y') ?> <?= getSetting('site_title') ?>. Tüm hakları saklıdır.</p>
                </div>
                <div class="footer-legal">
                    <a href="/privacy">Gizlilik Politikası</a>
                    <a href="/terms">Kullanım Şartları</a>
                    <a href="/kvkk">KVKK</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <div class="floating-whatsapp">
        <a href="<?= getWhatsAppLink() ?>" target="_blank" class="whatsapp-btn">
            <i class="fab fa-whatsapp"></i>
            <span class="tooltip">WhatsApp'tan Fotoğraf Gönder</span>
        </a>
    </div>

    <!-- Floating Call Button -->
    <div class="floating-call">
        <a href="tel:+90<?= getSetting('phone') ?>" class="call-btn">
            <i class="fas fa-phone"></i>
            <span class="tooltip">Hemen Ara</span>
        </a>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/animations.js"></script>
    <script src="assets/js/components.js"></script>
    
    <!-- Additional body content -->
    <?= isset($additional_body) ? $additional_body : '' ?>
</body>
</html>
