<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
require_once '../config/settings.php';

$database = new Database();
$db = $database->getConnection();
$settingsObj = new SiteSettings($db);

$success = '';
$error = '';

// Ayarları kaydet
if ($_POST) {
    try {
        foreach ($_POST as $key => $value) {
            if ($key !== 'submit') {
                $settingsObj->updateSetting($key, trim($value));
            }
        }
        $success = 'Ayarlar başarıyla güncellendi!';
    } catch (Exception $e) {
        $error = 'Bir hata oluştu: ' . $e->getMessage();
    }
}

// Mevcut ayarları getir
$settings = $settingsObj->getSettings();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Ayarları - Admin Panel</title>
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
        
        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #2D6B78;
            padding-bottom: 10px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
        }
        
        .form-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-section h3 {
            color: #2D6B78;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2D6B78;
        }
        
        .form-group small {
            color: #666;
            font-size: 12px;
        }
        
        .save-btn {
            background: linear-gradient(135deg, #2D6B78 0%, #4B9CAE 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        
        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <div class="admin-title">
                <h1><i class="fas fa-cog"></i> Site Ayarları</h1>
            </div>
            <div class="admin-user">
                <span><i class="fas fa-user-circle"></i> Hoş geldin, <?= $_SESSION['admin_username'] ?></span>
                <a href="logout.php" class="btn">
                    <i class="fas fa-sign-out-alt"></i> Çıkış
                </a>
            </div>
        </div>
    </header>
    
    <nav class="admin-nav">
        <div class="container">
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="settings.php" class="active"><i class="fas fa-cog"></i> Site Ayarları</a></li>
                <li><a href="../" target="_blank"><i class="fas fa-external-link-alt"></i> Siteyi Görüntüle</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="admin-content">
        <h2 class="section-title">Site Ayarları</h2>
        
        <?php if ($success): ?>
            <div class="alert success">
                <i class="fas fa-check-circle"></i> <?= $success ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-grid">
                <div class="form-section">
                    <h3><i class="fas fa-globe"></i> Genel Bilgiler</h3>
                    
                    <div class="form-group">
                        <label for="site_title">Site Başlığı</label>
                        <input type="text" id="site_title" name="site_title" value="<?= htmlspecialchars($settings['site_title'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="site_description">Site Açıklaması</label>
                        <textarea id="site_description" name="site_description" rows="3" required><?= htmlspecialchars($settings['site_description'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea id="meta_keywords" name="meta_keywords" rows="2"><?= htmlspecialchars($settings['meta_keywords'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="hero_title">Ana Sayfa Başlığı</label>
                        <input type="text" id="hero_title" name="hero_title" value="<?= htmlspecialchars($settings['hero_title'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="hero_description">Ana Sayfa Açıklaması</label>
                        <textarea id="hero_description" name="hero_description" rows="3"><?= htmlspecialchars($settings['hero_description'] ?? '') ?></textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3><i class="fas fa-phone"></i> İletişim Bilgileri</h3>
                    
                    <div class="form-group">
                        <label for="phone">Telefon Numarası</label>
                        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($settings['phone'] ?? '') ?>" required>
                        <small>Örnek: 0543 928 6154</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp Numarası</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($settings['whatsapp'] ?? '') ?>" required>
                        <small>Örnek: 905439286154 (ülke kodu ile, başında + yok)</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-posta Adresi</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($settings['email'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input type="text" id="address" name="address" value="<?= htmlspecialchars($settings['address'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="working_hours">Çalışma Saatleri</label>
                        <input type="text" id="working_hours" name="working_hours" value="<?= htmlspecialchars($settings['working_hours'] ?? '') ?>" required>
                        <small>Örnek: Pazartesi-Cumartesi: 09:00-18:00</small>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3><i class="fas fa-chart-bar"></i> İstatistikler</h3>
                    
                    <div class="form-group">
                        <label for="experience_years">Deneyim Yılı</label>
                        <input type="number" id="experience_years" name="experience_years" value="<?= htmlspecialchars($settings['experience_years'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="total_books">Toplam Alınan Kitap</label>
                        <input type="number" id="total_books" name="total_books" value="<?= htmlspecialchars($settings['total_books'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="happy_customers">Mutlu Müşteri Sayısı</label>
                        <input type="number" id="happy_customers" name="happy_customers" value="<?= htmlspecialchars($settings['happy_customers'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="satisfaction_rate">Memnuniyet Oranı (%)</label>
                        <input type="number" id="satisfaction_rate" name="satisfaction_rate" value="<?= htmlspecialchars($settings['satisfaction_rate'] ?? '') ?>" min="0" max="100" required>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3><i class="fas fa-share-alt"></i> Sosyal Medya</h3>
                    
                    <div class="form-group">
                        <label for="facebook_url">Facebook URL</label>
                        <input type="url" id="facebook_url" name="facebook_url" value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
                        <small>Tam URL: https://facebook.com/username</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="instagram_url">Instagram URL</label>
                        <input type="url" id="instagram_url" name="instagram_url" value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
                        <small>Tam URL: https://instagram.com/username</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="twitter_url">Twitter URL</label>
                        <input type="url" id="twitter_url" name="twitter_url" value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
                        <small>Tam URL: https://twitter.com/username</small>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="save-btn">
                <i class="fas fa-save"></i> Ayarları Kaydet
            </button>
        </form>
    </main>
</body>
</html>