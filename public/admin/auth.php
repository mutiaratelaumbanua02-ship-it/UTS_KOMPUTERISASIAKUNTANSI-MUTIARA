<?php
// Sertakan di setiap halaman admin: hanya admin yang sudah login boleh masuk.
require_once __DIR__ . '/db.php';
if (empty($_SESSION['admin'])) {
    flash('Silakan login terlebih dahulu.', 'error');
    redirect('login.php');
}
