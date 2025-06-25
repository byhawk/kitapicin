<?php
class SiteSettings {
    private $conn;
    private $table = 'site_settings';
    
    public function __construct($db) {
        $this->conn = $db;
        $this->createTable();
    }
    
    // Tabloyu oluştur
    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            setting_key VARCHAR(100) UNIQUE NOT NULL,
            setting_value TEXT,
            description VARCHAR(255),
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        try {
            $this->conn->exec($sql);
        } catch (Exception $e) {
            error_log("Tablo oluşturma hatası: " . $e->getMessage());
        }
    }
    
    // Tüm ayarları getir
    public function getSettings() {
        $settings = [];
        
        try {
            $query = "SELECT setting_key, setting_value FROM {$this->table} WHERE is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
            
        } catch (Exception $e) {
            error_log("Ayarları getirme hatası: " . $e->getMessage());
        }
        
        return $settings;
    }
    
    // Tek bir ayarı getir
    public function getSetting($key, $default = '') {
        try {
            $query = "SELECT setting_value FROM {$this->table} WHERE setting_key = ? AND is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $key);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['setting_value'];
            }
            
        } catch (Exception $e) {
            error_log("Ayar getirme hatası: " . $e->getMessage());
        }
        
        return $default;
    }
    
    // Ayarı güncelle veya ekle (UPSERT)
    public function updateSetting($key, $value, $description = '') {
        try {
            // Önce var mı kontrol et
            $checkQuery = "SELECT id FROM {$this->table} WHERE setting_key = ?";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(1, $key);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() > 0) {
                // Varsa güncelle
                $updateQuery = "UPDATE {$this->table} SET setting_value = ?, updated_at = NOW() WHERE setting_key = ?";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(1, $value);
                $updateStmt->bindParam(2, $key);
                $result = $updateStmt->execute();
                
                if (!$result) {
                    error_log("UPDATE hatası: " . print_r($updateStmt->errorInfo(), true));
                    throw new Exception("Ayar güncellenemedi: $key");
                }
            } else {
                // Yoksa ekle
                $insertQuery = "INSERT INTO {$this->table} (setting_key, setting_value, description) VALUES (?, ?, ?)";
                $insertStmt = $this->conn->prepare($insertQuery);
                $insertStmt->bindParam(1, $key);
                $insertStmt->bindParam(2, $value);
                $insertStmt->bindParam(3, $description);
                $result = $insertStmt->execute();
                
                if (!$result) {
                    error_log("INSERT hatası: " . print_r($insertStmt->errorInfo(), true));
                    throw new Exception("Ayar eklenemedi: $key");
                }
            }
            
            return true;
            
        } catch (Exception $e) {
            error_log("updateSetting hatası: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Birden fazla ayarı güncelle
    public function updateMultipleSettings($settings) {
        try {
            $this->conn->beginTransaction();
            
            foreach ($settings as $key => $value) {
                $this->updateSetting($key, $value);
            }
            
            $this->conn->commit();
            return true;
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Toplu güncelleme hatası: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Ayarı sil
    public function deleteSetting($key) {
        try {
            $query = "UPDATE {$this->table} SET is_active = 0 WHERE setting_key = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $key);
            return $stmt->execute();
            
        } catch (Exception $e) {
            error_log("Ayar silme hatası: " . $e->getMessage());
            return false;
        }
    }
    
    // Varsayılan ayarları yükle
    public function loadDefaultSettings() {
        $defaults = [
            'site_title' => 'Mavi Güneş Sahaf',
            'site_description' => 'İkinci el kitap alım satım uzmanı',
            'meta_keywords' => 'kitap, sahaf, ikinci el kitap, kitap alım, kitap satım',
            'hero_title' => 'Kitaplarınızın Değerini Keşfedin',
            'hero_description' => 'Uzman ekibimizle kitaplarınızın gerçek değerini belirliyor, adil fiyatlarla alım yapıyoruz.',
            'phone' => '0543 928 6154',
            'whatsapp' => '905439286154',
            'email' => 'info@mavigunesahaf.com',
            'address' => 'İstanbul, Türkiye',
            'working_hours' => 'Pazartesi-Cumartesi: 09:00-18:00',
            'experience_years' => '10',
            'total_books' => '50000',
            'happy_customers' => '2500',
            'satisfaction_rate' => '98',
            'facebook_url' => '',
            'instagram_url' => '',
            'twitter_url' => ''
        ];
        
        try {
            foreach ($defaults as $key => $value) {
                // Sadece mevcut olmayan ayarları ekle
                if (!$this->getSetting($key)) {
                    $this->updateSetting($key, $value);
                }
            }
            return true;
        } catch (Exception $e) {
            error_log("Varsayılan ayarlar yüklenemedi: " . $e->getMessage());
            return false;
        }
    }
}
?>