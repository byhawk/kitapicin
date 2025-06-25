<?php
function loadSettings() {
    global $settings;
    
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        if (!$db) {
            throw new Exception("Database bağlantısı kurulamadı");
        }
        
        $settingsObj = new SiteSettings($db);
        $settings = $settingsObj->getSettings();
        
    } catch (Exception $e) {
        error_log("loadSettings hatası: " . $e->getMessage());
        $settings = []; // Hata durumunda boş array
    }
    
    // Varsayılan değerler
    $defaults = [
        'site_title' => 'Mavi Güneş Sahaf',
        'site_description' => 'Ankara\'nın en güvenilir sahafı',
        'phone' => '0543 928 6154',
        'whatsapp' => '905439286154',
        'email' => 'sahfamavigunes@gmail.com',
        'address' => 'Çankaya, Ankara',
        'working_hours' => 'Pzt-Cmt: 09:00-18:00',
        'facebook_url' => '#',
        'instagram_url' => '#',
        'twitter_url' => '#',
        'experience_years' => '15',
        'total_books' => '50000',
        'happy_customers' => '5000',
        'satisfaction_rate' => '98',
        'hero_title' => 'Eski Kitaplarınızı En İyi Fiyatla Alıyoruz!',
        'hero_description' => 'WhatsApp\'tan fotoğraf gönderin, aynı gün adresinizden alalım! 15 yıllık deneyimimizle kitaplarınızı en adil şekilde değerlendiriyoruz.',
        'meta_keywords' => 'ankara sahaf, ikinci el kitap, kitap alım, antika kitap, eski kitap satış'
    ];
    
    foreach ($defaults as $key => $value) {
        if (!isset($settings[$key]) || empty($settings[$key])) {
            $settings[$key] = $value;
        }
    }
    
    return $settings;
}

function getSetting($key, $default = '') {
    global $settings;
    
    // Eğer ayarlar henüz yüklenmemişse yükle
    if (!isset($settings) || empty($settings)) {
        loadSettings();
    }
    
    return isset($settings[$key]) ? $settings[$key] : $default;
}

function formatPhone($phone) {
    return preg_replace('/(\d{4})(\d{3})(\d{2})(\d{2})/', '$1 $2 $3 $4', $phone);
}

function getWhatsAppLink($message = '') {
    $phone = getSetting('whatsapp');
    $defaultMessage = 'Merhaba, kitaplarım için değerlendirme yaptırmak istiyorum.';
    $message = $message ?: $defaultMessage;
    return "https://wa.me/{$phone}?text=" . urlencode($message);
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Güvenli HTML çıktı
function safeOutput($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Database bağlantı testi
function testDatabaseConnection() {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        if ($db) {
            $test = $db->query("SELECT 1")->fetch();
            return $test !== false;
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}

// URL helper - base path ile birlikte
function url($path = '') {
    $base = defined('BASE_PATH') ? BASE_PATH : '';
    return $base . '/' . ltrim($path, '/');
}

// Asset helper - CSS, JS, images için
function asset($path) {
    $base = defined('BASE_PATH') ? BASE_PATH : '';
    return $base . '/' . ltrim($path, '/');
}
?>