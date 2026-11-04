<?php
$title = 'Dashboard';
require_once __DIR__ . '/auth.php';

$total   = (int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$stok    = (int)$pdo->query('SELECT COALESCE(SUM(stock),0) FROM products')->fetchColumn();
$nilai   = (float)$pdo->query('SELECT COALESCE(SUM(price*stock),0) FROM products')->fetchColumn();
$menipis = (int)$pdo->query('SELECT COUNT(*) FROM products WHERE stock < 5')->fetchColumn();
$terbaru = $pdo->query('SELECT id, name, price, stock FROM products ORDER BY id DESC LIMIT 5')->fetchAll();

require __DIR__ . '/header.php';
?>
<h1>Dashboard Admin</h1>
<div class="cards">
  <div class="stat"><span>Total Produk</span><strong><?= $total ?></strong></div>
  <div class="stat"><span>Total Stok</span><strong><?= number_format($stok, 0, ',', '.') ?></strong></div>
  <div class="stat"><span>Nilai Stok</span><strong><?= rupiah($nilai) ?></strong></div>
  <div class="stat warn"><span>Stok Menipis (&lt; 5)</span><strong><?= $menipis ?></strong></div>
</div>

<div class="head">
  <h2>Produk Terbaru</h2>
  <a class="btn primary" href="product_form.php">+ Tambah Produk</a>
</div>
<div class="table-wrap">
<table>
  <thead><tr><th>ID</th><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr></thead>
  <tbody>
  <?php foreach ($terbaru as $p): ?>
    <tr><td><?= (int)$p['id'] ?></td><td><?= e($p['name']) ?></td><td><?= rupiah($p['price']) ?></td><td><?= (int)$p['stock'] ?></td></tr>
  <?php endforeach; ?>
  <?php if (!$terbaru): ?><tr><td colspan="4" class="empty">Belum ada produk.</td></tr><?php endif; ?>
  </tbody>
</table>
</div>
<p><a href="products.php">Lihat semua produk →</a></p>
<?php require __DIR__ . '/footer.php'; ?>
