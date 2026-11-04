<?php
require_once __DIR__ . '/auth.php';
$f = flash();
$cur = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Admin') ?> - Kelontong Store</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<aside class="sidebar" id="sidebar">
  <div class="side-brand">🛒 Kelontong Store</div>
  <nav>
    <a href="dashboard.php" class="<?= $cur === 'dashboard.php' ? 'active' : '' ?>">📊 Dashboard</a>
    <a href="products.php" class="<?= str_starts_with($cur, 'product') ? 'active' : '' ?>">📦 Produk</a>

    <a href="logout.php" class="logout" data-confirm-link="Yakin ingin logout?">🚪 Logout</a>
  </nav>
</aside>
<div class="content">
  <header class="topbar">
    <button class="menu-btn" id="menu-btn" aria-label="Menu">☰</button>
    <span class="topbar-title"><?= e($title ?? '') ?></span>
    <span class="user">👤 <?= e($_SESSION['admin']['username']) ?></span>
  </header>
  <main class="container">
  <?php if ($f): ?><div class="alert <?= e($f['type']) ?>" data-autohide><?= e($f['msg']) ?></div><?php endif; ?>
