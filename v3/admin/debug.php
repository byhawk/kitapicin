<?php
// Hata raporlamayı aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Admin Debug Testi</h1>";

// Session kontrolü
session_start();
echo "✓ Session başlatıldı<br>";

if (isset($_SESSION['admin_logged_in'])) {
    echo "✓ Admin session var: " . ($_SESSION['admin_logged_in'] ? 'true' : 'false') . "<br>";
    echo "✓ Admin username: " . ($_SESSION['admin_username'] ?? 'yok') . "<br>";
} else {
    echo "⚠ Admin session yok<br>";
}

// Database bağlantısı
try {
    require_once '../config/database.php';
    echo "✓ Database config yüklendi<br>";
    
    $database = new Database();
    echo "✓ Database sınıfı oluşturuldu<br>";
    
    $db = $database->getConnection();
    if ($db) {
        echo "✓ Database bağlantısı başarılı<br>";
    } else {
        echo "⚠ Database bağlantısı başarısız<br>";
    }
} catch (Exception $e) {
    echo "❌ Database hatası: " . $e->getMessage() . "<br>";
}

// Settings kontrolü
try {
    require_once '../config/settings.php';
    echo "✓ Settings config yüklendi<br>";
    
    $settingsObj = new SiteSettings($db);
    echo "✓ SiteSettings sınıfı oluşturuldu<br>";
    
} catch (Exception $e) {
    echo "❌ Settings hatası: " . $e->getMessage() . "<br>";
}

// Dosya kontrolü
$files = [
    'dashboard.php',
    'login.php', 
    'logout.php',
    'settings.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✓ $file dosyası mevcut<br>";
    } else {
        echo "❌ $file dosyası YOK<br>";
    }
}

echo "<hr>";
echo "<h2>Test Tamamlandı</h2>";
echo "<a href='simple-dashboard.php'>Basit Dashboard'u Test Et</a><br>";
echo "<a href='login.php'>Login Sayfasına Git</a>";
?>