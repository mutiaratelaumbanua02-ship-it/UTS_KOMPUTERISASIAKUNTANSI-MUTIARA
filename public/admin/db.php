<?php
// ====== KONFIGURASI (ubah jika perlu) ======
$DB_HOST = 'localhost';
$DB_NAME = 'mvc_mystore';
$DB_USER = 'root';
$DB_PASS = '';
// Username yang boleh masuk sebagai admin (huruf kecil semua)
$ADMIN_USERS = ['admin'];
// ===========================================

if (session_status() === PHP_SESSION_NONE) session_start();

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . $e->getMessage());
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function redirect($url) { header("Location: $url"); exit; }
function rupiah($n) { return 'Rp ' . number_format((float)$n, 0, ',', '.'); }
function flash($msg = null, $type = 'success') {
    if ($msg !== null) { $_SESSION['flash'] = ['msg' => $msg, 'type' => $type]; return; }
    $f = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $f;
}
function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_field() { return '<input type="hidden" name="csrf" value="' . csrf_token() . '">'; }
function csrf_check() {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(400); die('Permintaan tidak valid (CSRF). Muat ulang halaman.');
    }
}
