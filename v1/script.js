// script.js dosyası
document.addEventListener('DOMContentLoaded', function() {
    // Sayfa yüklendiğinde preloader'ı gizle
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
            // Preloader kaldırıldıktan sonra body'nin scroll'unu aktif et (eğer kapalıysa)
            document.body.style.overflow = '';
        }, 500); // CSS transition süresine uygun bir gecikme
    }

    // Hamburger menü işlevselliği
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Menü dışına tıklayınca menüyü kapatma (isteğe bağlı)
        document.addEventListener('click', (event) => {
            if (!navLinks.contains(event.target) && !hamburger.contains(event.target)) {
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                }
            }
        });

        // Menü linklerine tıklayınca menüyü kapatma
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                }
            });
        });
    }

    // Sectionların görünür hale gelmesi (scroll animasyonu)
    const sections = document.querySelectorAll('section');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Bir kere göründükten sonra gözlemlemeyi bırakmak isterseniz:
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    sections.forEach(section => {
        observer.observe(section);
    });

    // İletişim Formu İşlevselliği
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Sayfanın yeniden yüklenmesini engelle

            const formMessages = document.getElementById('form-messages');
            formMessages.style.display = 'none'; // Önceki mesajı temizle
            formMessages.classList.remove('success-message', 'error-message'); // Önceki sınıfları temizle

            // Basit bir doğrulama
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();

            if (name === '' || email === '' || message === '') {
                formMessages.textContent = 'Lütfen tüm zorunlu alanları doldurun.';
                formMessages.classList.add('error-message');
                formMessages.style.display = 'block';
                return;
            }

            // Basit e-posta formatı kontrolü
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                formMessages.textContent = 'Lütfen geçerli bir e-posta adresi girin.';
                formMessages.classList.add('error-message');
                formMessages.style.display = 'block';
                return;
            }

            // Bu kısımda form verilerini bir sunucuya gönderme işlemi yapılır (örneğin Fetch API ile).
            // Şu an için sadece başarılı bir mesaj gösteriyoruz.
            console.log('Form verileri gönderiliyor:', { name, email, message });

            // Simüle edilmiş sunucu yanıtı gecikmesi
            setTimeout(() => {
                formMessages.textContent = 'Mesajınız başarıyla gönderildi! Teşekkür ederiz.';
                formMessages.classList.add('success-message');
                formMessages.style.display = 'block';
                contactForm.reset(); // Formu sıfırla
            }, 1000); // 1 saniye sonra başarı mesajı göster
        });
    }
});


/* Navbar menü için js */
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger-menu');
    const mobileNav = document.querySelector('.mobile-nav');
    const navLinks = document.querySelectorAll('.mobile-nav a');
    const preloader = document.getElementById('preloader');

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        mobileNav.classList.toggle('active');
        document.body.classList.toggle('no-scroll'); /* Kaydırmayı engelle */
    });

    // Mobil menüdeki linklere tıklandığında menüyü kapat
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });
    });

    // Sayfa yüklendiğinde preloader'ı gizle
    window.addEventListener('load', function() {
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500); // Geçiş süresiyle aynı olmalı
        }
    });

    // Form gönderme işlemleri
    const contactForm = document.querySelector('.contact-form');
    const formMessages = document.getElementById('form-messages');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Formun varsayılan gönderme işlemini engelle

            const formData = new FormData(contactForm);

            // Fetch API kullanarak formu gönderme
            fetch(contactForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json' // Sunucudan JSON yanıt beklediğimizi belirtiriz
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Başarılı yanıtı JSON olarak ayrıştır
                } else {
                    // Hata durumunda yanıtı JSON veya metin olarak ayrıştırmaya çalış
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Form gönderilemedi.');
                    }).catch(() => {
                        // JSON olarak ayrıştırılamazsa metin olarak al
                        return response.text().then(text => {
                            throw new Error(text || 'Form gönderilemedi (metin yanıtı).');
                        });
                    });
                }
            })
            .then(data => {
                formMessages.textContent = 'Mesajınız başarıyla gönderildi!';
                formMessages.classList.remove('error-message');
                formMessages.classList.add('success-message');
                formMessages.style.display = 'block'; // Mesajı göster
                contactForm.reset(); // Formu sıfırla
            })
            .catch(error => {
                formMessages.textContent = 'Bir hata oluştu: ' + error.message;
                formMessages.classList.remove('success-message');
                formMessages.classList.add('error-message');
                formMessages.style.display = 'block'; // Mesajı göster
            });
        });
    }
});