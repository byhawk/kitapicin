<?php
// Session başlat
session_start();

// Config dosyalarını dahil et
require_once 'config/database.php';
require_once 'config/settings.php';
require_once 'includes/functions.php';

// Ayarları yükle
$settings = loadSettings();

// Base path'i otomatik belirle
$script_name = $_SERVER['SCRIPT_NAME']; // /demo/index.php
$base_path = dirname($script_name); // /demo
if ($base_path === '/') {
    $base_path = '';
}

// URL routing
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Base path'i kaldır
if ($base_path && strpos($path, $base_path) === 0) {
    $path = substr($path, strlen($base_path));
}

$path = trim($path, '/');

// Global değişken olarak base_path'i tanımla (navbar için)
define('BASE_PATH', $base_path);

// Sayfa belirleme
switch($path) {
    case '':
    case 'home':
        $current_page = 'home';
        $page_title = 'Ana Sayfa';
        $page_description = getSetting('hero_description');
        include 'includes/header.php';
        include 'includes/navbar.php';
        include 'pages/home.php';
        include 'includes/footer.php';
        break;
        
    case 'about':
        $current_page = 'about';
        $page_title = 'Hakkımızda';
        $page_description = getSetting('experience_years') . ' yıldır Ankara\'da güvenilir sahaf hizmeti. Hikayemizi öğrenin.';
        include 'includes/header.php';
        include 'includes/navbar.php';
        include 'pages/about.php';
        include 'includes/footer.php';
        break;
        
    case 'contact':
        $current_page = 'contact';
        $page_title = 'İletişim';
        $page_description = 'WhatsApp\'tan kitap fotoğrafı gönderin, hemen teklif alın!';
        include 'includes/header.php';
        include 'includes/navbar.php';
        include 'pages/contact.php';
        include 'includes/footer.php';
        break;
        
    case 'services':
        $current_page = 'services';
        $page_title = 'Hizmetlerimiz';
        $page_description = 'Hangi türde kitapları alıyoruz? Tüm hizmetlerimizi inceleyin.';
        include 'includes/header.php';
        include 'includes/navbar.php';
        include 'pages/services.php';
        include 'includes/footer.php';
        break;
        
    case 'admin':
		header('Location: admin/');
		exit();
		break;
        
    default:
        http_response_code(404);
        $page_title = '404 - Sayfa Bulunamadı';
        include 'includes/header.php';
        include 'includes/navbar.php';
        echo '<div class="container" style="text-align: center; padding: 5rem 0;">
                <h1>404</h1>
                <p>Aradığınız sayfa bulunamadı.</p>
                <a href="' . url() . '" class="btn btn-primary">Ana Sayfaya Dön</a>
              </div>';
        include 'includes/footer.php';
        break;
}
?>