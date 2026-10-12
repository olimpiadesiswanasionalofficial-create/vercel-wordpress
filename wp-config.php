<?php
/**
 * Konfigurasi Khusus Vercel Serverless
 */

// 1. Deteksi SSL dari Reverse Proxy Vercel agar tidak memicu 302 redirect loop
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// 2. Kunci URL Domain Situs
define( 'WP_HOME', 'https://osn-ujian-gamma.vercel.app' );
define( 'WP_SITEURL', 'https://osn-ujian-gamma.vercel.app' );

// 3. Penanganan Error & Exception (PHP 8.2+)
mysqli_report(MYSQLI_REPORT_OFF);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

// 4. Optimasi Serverless (Mencegah Freeze/Timeout)
define( 'DISABLE_WP_CRON', true );
define( 'WP_HTTP_BLOCK_EXTERNAL', false );
@ini_set( 'max_execution_time', 10 );
@ini_set( 'mysql.connect_timeout', 5 );
@ini_set( 'default_socket_timeout', 5 );

// Gunakan metode akses filesystem langsung tanpa meminta FTP
define( 'FS_METHOD', 'direct' );

// (Opsional) Nonaktifkan fitur install/update/delete file langsung dari admin
// karena di Vercel perubahan file harus lewat Git deployment
define( 'DISALLOW_FILE_MODS', true );

// Matikan pengecekan update otomatis yang menahan loading admin
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

// Blokir request background eksternal yang tidak diperlukan
define( 'WP_HTTP_BLOCK_EXTERNAL', false );

// 5. Direktori Sementara Vercel
define( 'WP_TEMP_DIR', '/tmp' );


/**
 * Pengaturan Database MySQL (TiDB Cloud)
 */
define( 'DB_NAME', getenv('DB_NAME') ?: 'wordpress' );
define( 'DB_USER', getenv('DB_USER') ?: 'root' );
define( 'DB_PASSWORD', getenv('DB_PASSWORD') ?: '' );
define( 'DB_HOST', getenv('DB_HOST') ?: '127.0.0.1' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', 'utf8mb4_general_ci' );

// Wajib: TiDB Cloud mewajibkan enkripsi SSL
define( 'MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL );


/**#@+
 * Kunci Autentikasi dan Salt
 */
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
/**#@-*/

/**
 * Prefiks Tabel Database WordPress
 */
$table_prefix = 'wp_';

/**
 * Mode Debug WordPress
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* Selesai konfigurasi dasar. */

/** Absolute path ke direktori WordPress */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Memuat environment WordPress dan fungsi pendukung */
require_once ABSPATH . 'wp-settings.php';
