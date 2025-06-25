<?php
// test.php - Demo klasörü routing testi
echo "<h1>🔍 Demo Klasörü Debug Test</h1>";
echo "<style>body{font-family:Arial;padding:20px;} pre{background:#f5f5f5;padding:10px;border-radius:5px;}</style>";

echo "<h2>📋 Server Variables:</h2>";
echo "<pre>";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "QUERY_STRING: " . ($_SERVER['QUERY_STRING'] ?? 'EMPTY') . "\n";
echo "GET params: " . print_r($_GET, true) . "\n";
echo "</pre>";

echo "<h2>📁 File Structure Check:</h2>";
echo "<pre>";
echo "Current directory: " . getcwd() . "\n";
echo "index.php exists: " . (file_exists('index.php') ? '✅ YES' : '❌ NO') . "\n";
echo ".htaccess exists: " . (file_exists('.htaccess') ? '✅ YES' : '❌ NO') . "\n";
echo "pages/ folder exists: " . (is_dir('pages') ? '✅ YES' : '❌ NO') . "\n";
echo "config/ folder exists: " . (is_dir('config') ? '✅ YES' : '❌ NO') . "\n";
echo "includes/ folder exists: " . (is_dir('includes') ? '✅ YES' : '❌ NO') . "\n";
echo "</pre>";

if (is_dir('pages')) {
    echo "<h2>📄 Pages Folder Contents:</h2>";
    echo "<pre>";
    $files = scandir('pages');
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "- " . $file . " (exists: " . (file_exists('pages/'.$file) ? '✅' : '❌') . ")\n";
        }
    }
    echo "</pre>";
}

echo "<h2>🔗 Test Links:</h2>";
echo '<div style="margin:10px 0;">';
echo '<a href="/demo/" style="margin-right:15px; padding:8px 15px; background:#007cba; color:white; text-decoration:none; border-radius:4px;">🏠 Ana Sayfa</a>';
echo '<a href="/demo/services" style="margin-right:15px; padding:8px 15px; background:#28a745; color:white; text-decoration:none; border-radius:4px;">📚 Hizmetlerimiz</a>';
echo '<a href="/demo/about" style="margin-right:15px; padding:8px 15px; background:#ffc107; color:black; text-decoration:none; border-radius:4px;">👥 Hakkımızda</a>';
echo '<a href="/demo/contact" style="margin-right:15px; padding:8px 15px; background:#dc3545; color:white; text-decoration:none; border-radius:4px;">📞 İletişim</a>';
echo '</div>';

echo "<h2>⚙️ Routing Test:</h2>";
echo "<pre>";
// Test routing logic
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

echo "Full REQUEST_URI: $request\n";
echo "Parsed PATH: $path\n";

$script_name = $_SERVER['SCRIPT_NAME']; // /demo/test.php
$base_path = dirname($script_name); // /demo
if ($base_path === '/') {
    $base_path = '';
}

echo "SCRIPT_NAME: $script_name\n";
echo "BASE_PATH: $base_path\n";

// Base path'i kaldır
if ($base_path && strpos($path, $base_path) === 0) {
    $path = substr($path, strlen($base_path));
}

$path = trim($path, '/');
echo "Final PATH after processing: '$path'\n";

// Test cases
$test_cases = ['services', 'about', 'contact', 'home', ''];
foreach ($test_cases as $test) {
    $file_path = "pages/$test.php";
    echo "\nTest case '$test':\n";
    echo "  Would look for: $file_path\n";
    echo "  File exists: " . (file_exists($file_path) ? '✅ YES' : '❌ NO') . "\n";
}
echo "</pre>";

echo "<h2>🧪 Index.php Test:</h2>";
echo "<pre>";
if (file_exists('index.php')) {
    echo "index.php exists ✅\n";
    echo "Trying to include routing logic...\n";
    
    // index.php'nin ilk birkaç satırını oku
    $content = file_get_contents('index.php', false, null, 0, 1000);
    echo "\nFirst 1000 chars of index.php:\n";
    echo htmlspecialchars($content);
} else {
    echo "index.php NOT FOUND ❌\n";
}
echo "</pre>";

// htaccess test
echo "<h2>📝 .htaccess Content:</h2>";
echo "<pre>";
if (file_exists('.htaccess')) {
    echo "✅ .htaccess exists\n\nContent:\n";
    echo htmlspecialchars(file_get_contents('.htaccess'));
} else {
    echo "❌ .htaccess NOT FOUND\n";
}
echo "</pre>";
?>