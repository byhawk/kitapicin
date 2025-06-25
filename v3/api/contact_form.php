header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST metodu desteklenir.']);
    exit;
}

require_once '../config/database.php';

// Form verilerini al ve temizle
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basit validasyon
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Zorunlu alanları doldurun.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Geçerli bir e-posta adresi girin.']);
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO contact_messages (name, email, phone, subject, message, ip_address, user_agent, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $subject);
    $stmt->bindParam(5, $message);
    $stmt->bindParam(6, $_SERVER['REMOTE_ADDR']);
    $stmt->bindParam(7, $_SERVER['HTTP_USER_AGENT']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Mesajınız başarıyla gönderildi!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Mesaj gönderilirken bir hata oluştu.']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Sistem hatası oluştu.']);
}
?>