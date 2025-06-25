<?php
// Output buffering başlat - headers already sent problemini çözer
ob_start();

// Hata raporlama
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session başlat
session_start();

// Zaten giriş yapmışsa dashboard'a yönlendir
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit();
}

require_once '../config/database.php';

$error = '';

if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if ($username && $password) {
        $database = new Database();
        $db = $database->getConnection();
        
        if ($db) {
            // Admin_users tablosu var mı kontrol et
            try {
                $table_check = $db->query("SHOW TABLES LIKE 'admin_users'")->fetch();
                
                if (!$table_check) {
                    $error = 'Admin tablosu bulunamadı. Lütfen önce create-admin.php ile kullanıcı oluşturun.';
                } else {
                    $query = "SELECT id, username, password, email, role FROM admin_users WHERE username = ? AND is_active = 1";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(1, $username);
                    $stmt->execute();
                    
                    if ($stmt->rowCount() > 0) {
                        $user = $stmt->fetch();
                        
                        if (password_verify($password, $user['password'])) {
                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = $user['id'];
                            $_SESSION['admin_username'] = $user['username'];
                            $_SESSION['admin_role'] = $user['role'];
                            
                            // Son giriş zamanını güncelle
                            $update_query = "UPDATE admin_users SET last_login = NOW() WHERE id = ?";
                            $update_stmt = $db->prepare($update_query);
                            $update_stmt->bindParam(1, $user['id']);
                            $update_stmt->execute();
                            
                            header('Location: dashboard.php');
                            exit();
                        } else {
                            $error = 'Geçersiz kullanıcı adı veya şifre!';
                        }
                    } else {
                        $error = 'Geçersiz kullanıcı adı veya şifre!';
                    }
                }
            } catch (Exception $e) {
                $error = 'Veritabanı hatası: ' . $e->getMessage();
            }
        } else {
            $error = 'Database bağlantısı kurulamadı!';
        }
    } else {
        $error = 'Lütfen tüm alanları doldurun!';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş - Mavi Güneş Sahaf</title>
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
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #2D6B78;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #666;
            font-size: 16px;
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
        
        .form-group i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        .input-wrapper {
            position: relative;
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
        }
        
        .btn:hover {
            transform: translateY(-2px);
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
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .links {
            text-align: center;
            margin-top: 15px;
        }
        
        .links a {
            color: #2D6B78;
            text-decoration: none;
            font-size: 14px;
            margin: 0 10px;
        }
        
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-book"></i> Admin Panel</h1>
            <p>Mavi Güneş Sahaf Yönetim Sistemi</p>
        </div>
        
        <?php if ($error): ?>
            <div class="error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <div class="input-wrapper">
                    <input type="text" id="username" name="username" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Şifre</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i> Giriş Yap
            </button>
        </form>
        
        <div class="links">
            <a href="create-admin.php"><i class="fas fa-user-plus"></i> Admin Oluştur</a> |
            <a href="../"><i class="fas fa-home"></i> Ana Site</a>
        </div>
        
        <div class="footer-text">
            &copy; <?= date('Y') ?> Mavi Güneş Sahaf
        </div>
    </div>
</body>
</html>