<?php
// admin/create-admin.php - İlk admin kullanıcısını oluştur
require_once '../config/database.php';

$success = '';
$error = '';

// Form gönderildi
if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    
    if ($username && $password && $email) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            // Admin_users tablosunu oluştur
            $create_table = "
                CREATE TABLE IF NOT EXISTS admin_users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    role ENUM('admin', 'super_admin') DEFAULT 'admin',
                    is_active TINYINT(1) DEFAULT 1,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    last_login TIMESTAMP NULL,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ";
            
            $db->exec($create_table);
            
            // Kullanıcı var mı kontrol et
            $check_query = "SELECT COUNT(*) as count FROM admin_users WHERE username = ? OR email = ?";
            $check_stmt = $db->prepare($check_query);
            $check_stmt->execute([$username, $email]);
            $existing = $check_stmt->fetch();
            
            if ($existing['count'] > 0) {
                $error = 'Bu kullanıcı adı veya e-posta zaten kullanılıyor!';
            } else {
                // Şifreyi hash'le
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Admin kullanıcısını ekle
                $insert_query = "INSERT INTO admin_users (username, password, email, role) VALUES (?, ?, ?, 'super_admin')";
                $insert_stmt = $db->prepare($insert_query);
                
                if ($insert_stmt->execute([$username, $hashed_password, $email])) {
                    $success = 'Admin kullanıcısı başarıyla oluşturuldu! Şimdi giriş yapabilirsiniz.';
                } else {
                    $error = 'Kullanıcı oluşturulurken bir hata oluştu.';
                }
            }
            
        } catch (Exception $e) {
            $error = 'Veritabanı hatası: ' . $e->getMessage();
        }
    } else {
        $error = 'Lütfen tüm alanları doldurun!';
    }
}

// Mevcut admin sayısını kontrol et
try {
    $database = new Database();
    $db = $database->getConnection();
    
    $count_query = "SELECT COUNT(*) as count FROM admin_users WHERE is_active = 1";
    $count_stmt = $db->prepare($count_query);
    $count_stmt->execute();
    $admin_count = $count_stmt->fetch()['count'];
    
} catch (Exception $e) {
    $admin_count = 0;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kullanıcı Oluştur - Mavi Güneş Sahaf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #667eea 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .setup-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .setup-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .setup-header h1 {
            color: #2D6B78;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .setup-header p {
            color: #666;
            font-size: 16px;
        }
        
        .info-box {
            background: #e7f3ff;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .info-box.success {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #2D6B78;
        }
        
        .form-group small {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #2D6B78 0%, #4B9CAE 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn.secondary {
            background: #6c757d;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .error {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #fcc;
        }
        
        .success {
            background: #efe;
            color: #383;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #cfc;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="setup-header">
            <h1><i class="fas fa-user-plus"></i> Admin Kurulum</h1>
            <p>İlk admin kullanıcısını oluşturun</p>
        </div>
        
        <?php if ($admin_count > 0): ?>
            <div class="info-box success">
                <i class="fas fa-check-circle"></i> 
                Sistemde <?= $admin_count ?> aktif admin kullanıcısı bulunuyor.
            </div>
        <?php else: ?>
            <div class="info-box">
                <i class="fas fa-info-circle"></i> 
                Henüz admin kullanıcısı yok. İlk kullanıcıyı oluşturun.
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success">
                <i class="fas fa-check-circle"></i> <?= $success ?>
            </div>
            <a href="login.php" class="btn">
                <i class="fas fa-sign-in-alt"></i> Giriş Sayfasına Git
            </a>
        <?php else: ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" id="username" name="username" required 
                           value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                           pattern="[a-zA-Z0-9_]{3,20}" title="3-20 karakter, sadece harf, rakam ve alt çizgi">
                    <small>3-20 karakter, sadece harf, rakam ve alt çizgi kullanabilirsiniz</small>
                </div>
                
                <div class="form-group">
                    <label for="email">E-posta Adresi</label>
                    <input type="email" id="email" name="email" required 
                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    <small>Geçerli bir e-posta adresi girin</small>
                </div>
                
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" id="password" name="password" required 
                           minlength="6" title="En az 6 karakter">
                    <small>En az 6 karakter uzunluğunda olmalı</small>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i> Admin Kullanıcısı Oluştur
                </button>
            </form>
        <?php endif; ?>
        
        <a href="../" class="btn secondary">
            <i class="fas fa-home"></i> Ana Siteye Dön
        </a>
        
        <div class="footer-text">
            &copy; <?= date('Y') ?> Mavi Güneş Sahaf
        </div>
    </div>
</body>
</html>