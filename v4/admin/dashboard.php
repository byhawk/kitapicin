<?php
// Output buffering başlat
ob_start();

// Hata raporlama
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session başlat
session_start();

// Giriş kontrolü
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
require_once '../config/settings.php';

$database = new Database();
$db = $database->getConnection();
$settingsObj = new SiteSettings($db);

// İstatistikler
$stats = [
    'total_settings' => 0,
    'total_messages' => 0,
    'unread_messages' => 0,
    'last_message' => null
];

// Ayar sayısı
try {
    $query = "SELECT COUNT(*) as count FROM site_settings WHERE is_active = 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_settings'] = $stmt->fetch()['count'];
} catch (Exception $e) {
    $stats['total_settings'] = 0;
}

// Mesaj sayısı (tablo yoksa 0)
try {
    $query = "SELECT COUNT(*) as count FROM contact_messages";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_messages'] = $stmt->fetch()['count'];
    
    // Okunmamış mesaj sayısı
    $query = "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['unread_messages'] = $stmt->fetch()['count'];
    
    // Son mesaj
    $query = "SELECT name, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stats['last_message'] = $stmt->fetch();
    }
} catch (Exception $e) {
    // contact_messages tablosu yoksa varsayılan değerler kullan
    $stats['total_messages'] = 0;
    $stats['unread_messages'] = 0;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mavi Güneş Sahaf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #2D6B78 0%, #4B9CAE 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .admin-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-title h1 {
            font-size: 24px;
            font-weight: 600;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-nav {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 0;
        }
        
        .admin-nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .admin-nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }
        
        .admin-nav a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            padding: 10px 0;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .admin-nav a:hover,
        .admin-nav a.active {
            color: #2D6B78;
            border-bottom-color: #2D6B78;
        }
        
        .admin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #2D6B78;
        }
        
        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
            color: #2D6B78;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .action-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
        }
        
        .action-card a {
            text-decoration: none;
            color: inherit;
        }
        
        .action-card i {
            font-size: 36px;
            color: #2D6B78;
            margin-bottom: 15px;
        }
        
        .action-card h4 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .action-card p {
            color: #666;
            font-size: 14px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        
        .btn:hover {
            background: #c82333;
        }
        
        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #2D6B78;
            padding-bottom: 10px;
        }
        
        .welcome-message {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 4px solid #2D6B78;
        }
        
        .welcome-message h2 {
            color: #2D6B78;
            margin-bottom: 10px;
        }
        
        .welcome-message p {
            color: #666;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <div class="admin-title">
                <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
            </div>
            <div class="admin-user">
                <span><i class="fas fa-user-circle"></i> Hoş geldin, <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
                <a href="logout.php" class="btn">
                    <i class="fas fa-sign-out-alt"></i> Çıkış
                </a>
            </div>
        </div>
    </header>
    
    <nav class="admin-nav">
        <div class="container">
            <ul>
                <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Site Ayarları</a></li>
                <li><a href="../" target="_blank"><i class="fas fa-external-link-alt"></i> Siteyi Görüntüle</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="admin-content">
        <div class="welcome-message">
            <h2><i class="fas fa-check-circle"></i> Sisteme Başarıyla Giriş Yaptın!</h2>
            <p><strong>Giriş Zamanı:</strong> <?= date('d.m.Y H:i:s') ?></p>
            <p><strong>Admin Rolü:</strong> <?= htmlspecialchars($_SESSION['admin_role'] ?? 'Admin') ?></p>
        </div>
        
        <h2 class="section-title">Genel Bakış</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3><?= $stats['total_settings'] ?></h3>
                <p>Toplam Ayar</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['total_messages'] ?></h3>
                <p>Toplam Mesaj</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['unread_messages'] ?></h3>
                <p>Okunmamış Mesaj</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['last_message'] ? date('d.m.Y', strtotime($stats['last_message']['created_at'])) : 'Yok' ?></h3>
                <p>Son Mesaj</p>
            </div>
        </div>
        
        <h2 class="section-title">Hızlı İşlemler</h2>
        
        <div class="quick-actions">
            <div class="action-card">
                <a href="settings.php">
                    <i class="fas fa-cog"></i>
                    <h4>Site Ayarları</h4>
                    <p>Telefon, e-posta, sosyal medya linklerini düzenle</p>
                </a>
            </div>
            <div class="action-card">
                <a href="../" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <h4>Siteyi Görüntüle</h4>
                    <p>Canlı siteyi yeni sekmede aç</p>
                </a>
            </div>
            <div class="action-card">
                <a href="create-admin.php">
                    <i class="fas fa-user-plus"></i>
                    <h4>Admin Kullanıcı Oluştur</h4>
                    <p>Yeni admin hesabı ekle</p>
                </a>
            </div>
            <div class="action-card">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <h4>Güvenli Çıkış</h4>
                    <p>Admin panelinden çık</p>
                </a>
            </div>
        </div>
    </main>
</body>
</html>