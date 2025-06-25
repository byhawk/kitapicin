<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'palsosya_mavigunes';
    private $username = 'palsosya_mavi';
    private $password = 'MeRt06-+';
    private $charset = 'utf8mb4';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $this->conn;
            
        } catch(PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            
            // Debug modunda hata göster
            if (defined('DEBUG') && DEBUG) {
                echo "Connection error: " . $e->getMessage();
            }
            
            return null;
        }
    }
    
    // Test bağlantısı
    public function testConnection() {
        $conn = $this->getConnection();
        if ($conn) {
            try {
                $stmt = $conn->query("SELECT 1");
                return $stmt !== false;
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }
}

// Site_settings tablosunun var olup olmadığını kontrol et ve gerekirse oluştur
function ensureSettingsTable() {
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        if (!$conn) {
            return false;
        }
        
        // Tablo var mı kontrol et
        $table_check = $conn->query("SHOW TABLES LIKE 'site_settings'")->fetch();
        
        if (!$table_check) {
            // Tablo yoksa oluştur
            $create_table = "
                CREATE TABLE site_settings (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    setting_key VARCHAR(255) UNIQUE NOT NULL,
                    setting_value TEXT,
                    description TEXT,
                    is_active TINYINT(1) DEFAULT 1,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ";
            
            $conn->exec($create_table);
            
            // Varsayılan birkaç ayar ekle
            $default_settings = [
                ['site_title', 'Mavi Güneş Sahaf', 'Site başlığı'],
                ['hero_description', 'WhatsApp\'tan fotoğraf gönderin, hemen teklif alın!', 'Ana sayfa açıklama'],
                ['experience_years', '15', 'Deneyim yılı']
            ];
            
            $stmt = $conn->prepare("INSERT INTO site_settings (setting_key, setting_value, description) VALUES (?, ?, ?)");
            foreach ($default_settings as $setting) {
                $stmt->execute($setting);
            }
            
            return true;
        }
        
        return true;
        
    } catch (Exception $e) {
        error_log("Table creation error: " . $e->getMessage());
        return false;
    }
}

// İlk yüklemede tablo kontrolü yap
ensureSettingsTable();
?>