<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' . getSetting('site_title') : getSetting('site_title') ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : getSetting('site_description') ?>">
    <meta name="keywords" content="<?= getSetting('meta_keywords') ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($page_title) ? $page_title . ' - ' . getSetting('site_title') : getSetting('site_title') ?>">
    <meta property="og:description" content="<?= isset($page_description) ? $page_description : getSetting('site_description') ?>">
    <meta property="og:image" content="assets/images/og-image.jpg">
    <meta property="og:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:type" content="website">
    
    <!-- Additional head content -->
    <?= isset($additional_head) ? $additional_head : '' ?>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="preloader-content">
            <div class="book-loader">
                <div class="book">
                    <div class="page"></div>
                    <div class="page"></div>
                    <div class="page"></div>
                </div>
            </div>
            <h3><?= getSetting('site_title') ?></h3>
            <p>Kitapların büyülü dünyasına hoş geldiniz...</p>
        </div>
    </div>

    <!-- Floating Background Elements -->
    <div class="floating-bg">
        <div class="floating-element" data-speed="2">📚</div>
        <div class="floating-element" data-speed="3">📖</div>
        <div class="floating-element" data-speed="1">📙</div>
        <div class="floating-element" data-speed="4">📗</div>
        <div class="floating-element" data-speed="2">📘</div>
        <div class="floating-element" data-speed="3">📕</div>
    </div>

