<?php
// Tangkap path URL yang diminta
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = dirname(__DIR__) . $path;

// Jika file fisik ada (misal: /wp-admin/install.php atau aset .css/.js), biarkan server menjalankannya langsung
if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Jika direktori diminta dan terdapat file index.php di dalamnya (misal: /wp-admin/)
if (is_dir($file) && file_exists(rtrim($file, '/') . '/index.php')) {
    return false;
}

// Fallback: jalankan frontend WordPress
require dirname(__DIR__) . '/index.php';
