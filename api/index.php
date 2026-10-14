<?php
// Naikkan memory limit khusus serverless
ini_set('memory_limit', '512M');

// Tampilkan fatal error ke log Vercel jika terjadi crash
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log("FATAL ERROR: {$error['message']} in {$error['file']} on line {$error['line']}");
    }
});

// Tampilkan error langsung ke log Vercel untuk mendiagnosis
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Tangkap URI dan path yang diminta
$uri  = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);
$root = dirname(__DIR__);
$file = $root . $path;

// 1. Jika permintaan adalah file statis non-PHP (CSS, JS, gambar, font), biarkan server menyajikannya langsung
$extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$staticExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp', 'woff', 'woff2', 'ttf', 'eot'];

if (in_array($extension, $staticExtensions, true) && file_exists($file)) {
    // Tambahkan header caching 7 hari untuk file statis
    header('Cache-Control: public, max-age=604800, immutable');
    return false;
}
$extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$staticExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp', 'woff', 'woff2', 'ttf', 'eot'];

if (in_array($extension, $staticExtensions, true) && file_exists($file)) {
    return false;
}

// 2. Tentukan target file PHP yang harus dijalankan
$targetScript = $root . '/index.php'; // Default halaman utama / permalink WordPress

if ($path !== '/' && file_exists($file)) {
    if (is_dir($file) && file_exists(rtrim($file, '/') . '/index.php')) {
        $targetScript = rtrim($file, '/') . '/index.php';
    } elseif ($extension === 'php') {
        $targetScript = $file;
    }
}

// 3. Sinkronkan server environment agar WordPress mengenali script yang aktif
$_SERVER['SCRIPT_FILENAME'] = $targetScript;
$_SERVER['SCRIPT_NAME']     = str_replace($root, '', $targetScript);
$_SERVER['PHP_SELF']        = $_SERVER['SCRIPT_NAME'];

// Pindah working directory ke folder script terkait
chdir(dirname($targetScript));

// Eksekusi file PHP
require $targetScript;
