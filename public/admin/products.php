<?php
$title = 'Kelola Produk';
require_once __DIR__ . '/auth.php';

// DELETE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    csrf_check();
    $pdo->prepare('DELETE FROM products WHERE id = ?')->execute([(int)$_POST['id']]);
    flash('Produk berhasil dihapus.');
    redirect('products.php');
}

// READ
$products = $pdo->query('SELECT id, name, price, stock FROM products ORDER BY id DESC')->fetchAll();
require __DIR__ . '/header.php';
?>
<div class="head">
  <h1>Kelola Produk <small class="muted">(<?= count($products) ?> item)</small></h1>
  <a class="btn primary" href="product_form.php">+ Tambah Produk</a>
</div>
<input type="text" id="search" class="search" placeholder="Cari produk...">
<div class="table-wrap">
<table id="data-table">
  <thead><tr><th>No</th><th>Nama Produk</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
  <tbody>
  <?php foreach ($products as $i => $p): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= e($p['name']) ?></td>
      <td><?= rupiah($p['price']) ?></td>
      <td>
        <?= (int)$p['stock'] ?>
        <?php if ($p['stock'] < 5): ?><span class="badge">Menipis</span><?php endif; ?>
      </td>
      <td class="aksi">
        <a class="btn warn" href="product_form.php?id=<?= (int)$p['id'] ?>">Edit</a>
        <form method="post" data-confirm="Hapus produk <?= e($p['name']) ?>?">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <button class="btn danger">Hapus</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$products): ?><tr><td colspan="5" class="empty">Belum ada produk.</td></tr><?php endif; ?>
  </tbody>
</table>
</div>
<?php require __DIR__ . '/footer.php'; ?>
