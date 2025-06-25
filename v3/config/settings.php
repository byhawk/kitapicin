<?php
	class SiteSettings {
    private $conn;
    private $table_name = "site_settings";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ayarları getir
    public function getSettings() {
        $query = "SELECT setting_key, setting_value FROM " . $this->table_name . " WHERE is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    // Tek ayar getir
    public function getSetting($key) {
        $query = "SELECT setting_value FROM " . $this->table_name . " WHERE setting_key = ? AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $key);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row ? $row['setting_value'] : null;
    }

    // Ayar güncelle
    public function updateSetting($key, $value) {
        $query = "UPDATE " . $this->table_name . " SET setting_value = ?, updated_at = NOW() WHERE setting_key = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $key);
        return $stmt->execute();
    }

    // Yeni ayar ekle
    public function addSetting($key, $value, $description = '') {
        $query = "INSERT INTO " . $this->table_name . " (setting_key, setting_value, description, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $key);
        $stmt->bindParam(2, $value);
        $stmt->bindParam(3, $description);
        return $stmt->execute();
    }
}
?>