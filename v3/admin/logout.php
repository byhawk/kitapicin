<?php
// Output buffering başlat
ob_start();

// Session başlat
session_start();

// Session verilerini temizle
session_unset();
session_destroy();

// Login sayfasına yönlendir
header('Location: login.php');
exit();
?>