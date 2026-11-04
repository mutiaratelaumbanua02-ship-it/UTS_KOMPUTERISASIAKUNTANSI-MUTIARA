<?php
require_once __DIR__ . '/db.php';
unset($_SESSION['admin']);
session_regenerate_id(true);
flash('Anda berhasil logout.');
redirect('login.php');
