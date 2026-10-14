<?php
// 1. Alokasi Memori & Penanganan Error Logging
ini_set('memory_limit', '512M');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Catat detail Fatal Error ke log Vercel jika terjadi crash
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log("FATAL ERROR: {$error['message']} in {$error['file']} on line {$error['line']}");
    }
});

// 2. Tangkap URI dan Path yang Diminta
$uri  = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);
$root = dirname(__DIR__);
$file = $root . $path;

// 3. Layani Aset Statis (CSS, JS, Gambar, Font, Favicon)
$extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$staticExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp', 'woff', 'woff2', 'ttf', 'eot'];

if (in_array($extension, $staticExtensions, true) && file_exists($file)) {
    header('Cache-Control: public, max-age=604800, immutable');
    return false;
}

// 4. Tentukan File PHP Target yang Akan Dieksekusi
$targetScript = $root . '/index.php'; // Default fallback WordPress

if ($path !== '/' && file_exists($file)) {
    if (is_dir($file) && file_exists(rtrim($file, '/') . '/index.php')) {
        $targetScript = rtrim($file, '/') . '/index.php';
    } elseif ($extension === 'php') {
        $targetScript = $file;
    }
}

// 5. Sinkronkan Environment Server untuk WordPress
$_SERVER['SCRIPT_FILENAME'] = $targetScript;
$_SERVER['SCRIPT_NAME']     = str_replace($root, '', $targetScript);
$_SERVER['PHP_SELF']        = $_SERVER['SCRIPT_NAME'];

// Pindah working directory ke folder target script
chdir(dirname($targetScript));

// Eksekusi file target
require $targetScript;
