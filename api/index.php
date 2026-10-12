<?php
// Mencegah output teks bocor sebelum header dikirim
ob_start();
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

// Kode require bawaan Anda (misalnya index.php WordPress)
require __DIR__ . '/../index.php';
