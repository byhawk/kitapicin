<?php
// admin/index.php - Giriş kontrolü ve yönlendirme
session_start();

// Eğer admin girişi yapmışsa dashboard'a yönlendir
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Dashboard'u include et
    include 'dashboard.php';
} else {
    // Giriş yapmamışsa login sayfasına yönlendir
    include 'login.php';
}
?>