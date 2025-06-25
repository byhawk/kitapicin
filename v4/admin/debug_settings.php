<?php
// Debug sayfası - Site ayarları sorunlarını tespit etmek için
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    die('Admin girişi gerekli');
}

require_once '../config/database.php';
require_once '../config/settings.php';

echo "<h1>Site Ayarları Debug</h1>";
echo "<style>body{font-family:Arial;padding:20px} .success{color:green} .error{color:red} .info{color:blue} pre{background:#f5f5f5;padding:10px;border-radius:5px}</style>";

try {
    // Database bağlantısı test
    $database = new Database();
    $db = $database->getConnection();
    echo "<p class='success'>✓ Database bağlantısı başarılı</p>";
    
    // SiteSettings sınıfı test
    $settingsObj = new SiteSettings($db);
    echo "<p class='success'>✓ SiteSettings sınıfı oluşturuldu</p>";
    
    // Tablo kontrolü
    $query = "SHOW TABLES LIKE 'site_settings'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<p class='success'>✓ site_settings tablosu mevcut</p>";
        
        // Tablo yapısını göster
        $query = "DESCRIBE site_settings";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $columns = $stmt->fetchAll();
        
        echo "<h3>Tablo Yapısı:</h3>";
        echo "<pre>";
        foreach ($columns as $col) {
            echo $col['Field'] . " - " . $col['Type'] . " - " . $col['Null'] . " - " . $col['Default'] . "\n";
        }
        echo "</pre>";
        
        // Mevcut kayıtları göster
        $query = "SELECT * FROM site_settings";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $records = $stmt->fetchAll();
        
        echo "<h3>Mevcut Kayıtlar (" . count($records) . " adet):</h3>";
        echo "<pre>";
        foreach ($records as $record) {
            echo "ID: " . $record['id'] . " | Key: " . $record['setting_key'] . " | Value: " . substr($record['setting_value'], 0, 50) . "...\n";
        }
        echo "</pre>";
        
    } else {
        echo "<p class='error'>❌ site_settings tablosu yok</p>";
        echo "<p class='info'>Tablo oluşturuluyor...</p>";
        
        // Tabloyu oluşturmayı dene
        $settingsObj = new SiteSettings($db);
        echo "<p class='success'>✓ Tablo oluşturuldu</p>";
    }
    
    // Test yazma işlemi
    echo "<h3>Test Yazma İşlemi:</h3>";
    $testKey = 'test_setting_' . time();
    $testValue = 'Test değeri: ' . date('Y-m-d H:i:s');
    
    $result = $settingsObj->updateSetting($testKey, $testValue);
    if ($result) {
        echo "<p class='success'>✓ Test ayarı yazıldı: $testKey = $testValue</p>";
        
        // Okumayı test et
        $readValue = $settingsObj->getSetting($testKey);
        if ($readValue === $testValue) {
            echo "<p class='success'>✓ Test ayarı okundu: $readValue</p>";
        } else {
            echo "<p class='error'>❌ Test ayarı okunamadı. Beklenen: $testValue, Okunan: $readValue</p>";
        }
        
        // Test ayarını sil
        $settingsObj->deleteSetting($testKey);
        echo "<p class='info'>Test ayarı silindi</p>";
        
    } else {
        echo "<p class='error'>❌ Test ayarı yazılamadı</p>";
    }
    
    // Form POST test
    if ($_POST) {
        echo "<h3>Form POST Test:</h3>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        foreach ($_POST as $key => $value) {
            if ($key !== 'test_submit') {
                try {
                    $result = $settingsObj->updateSetting($key, $value);
                    echo "<p class='success'>✓ $key güncellendi</p>";
                } catch (Exception $e) {
                    echo "<p class='error'>❌ $key güncellenemedi: " . $e->getMessage() . "</p>";
                }
            }
        }
    }
    
} catch (Exception $e) {
    echo "<p class='error'>❌ Hata: " . $e->getMessage() . "</p>";
}
?>

<h3>Test Formu:</h3>
<form method="POST">
    <p>
        <label>Test Key:</label><br>
        <input type="text" name="debug_test_key" value="test_debug_setting" style="width:300px">
    </p>
    <p>
        <label>Test Value:</label><br>
        <input type="text" name="debug_test_value" value="Debug test değeri <?= date('H:i:s') ?>" style="width:300px">
    </p>
    <p>
        <button type="submit" name="test_submit" value="1">Test Et</button>
    </p>
</form>

<hr>
<p>
    <a href="settings.php">← Ayarlar Sayfasına Dön</a> |
    <a href="dashboard.php">Dashboard</a>
</p>