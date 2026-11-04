<?php
$title = 'Form Produk';
require_once __DIR__ . '/auth.php';

$id = (int)($_GET['id'] ?? 0);
$p = ['name' => '', 'price' => '', 'stock' => ''];
if ($id) {
    $stmt = $pdo->prepare('SELECT id, name, price, stock FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $p = $stmt->fetch();
    if (!$p) { flash('Produk tidak ditemukan.', 'error'); redirect('products.php'); }
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name  = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $p = ['name' => $name, 'price' => $price, 'stock' => $stock];

    if ($name === '') $errors[] = 'Nama produk wajib diisi.';
    if (!is_numeric($price) || $price < 0) $errors[] = 'Harga harus berupa angka >= 0.';
    if (!ctype_digit((string)$stock)) $errors[] = 'Stok harus berupa bilangan bulat >= 0.';

    if (!$errors) {
        if ($id) {
            $pdo->prepare('UPDATE products SET name=?, price=?, stock=? WHERE id=?')->execute([$name, $price, $stock, $id]);
            flash('Produk berhasil diperbarui.');
        } else {
            $pdo->prepare('INSERT INTO products (name, price, stock) VALUES (?,?,?)')->execute([$name, $price, $stock]);
            flash('Produk baru berhasil ditambahkan.');
        }
        redirect('products.php');
    }
}
require __DIR__ . '/header.php';
?>
<h1><?= $id ? 'Update Produk' : 'Tambah Produk Baru' ?></h1>
<?php foreach ($errors as $err): ?><div class="alert error"><?= e($err) ?></div><?php endforeach; ?>
<form method="post" class="card form">
  <?= csrf_field() ?>
  <label>Nama Produk
    <input type="text" name="name" value="<?= e($p['name']) ?>" required>
  </label>
  <label>Harga (Rp)
    <input type="number" name="price" id="price" min="0" step="1" value="<?= e($p['price']) ?>" required>
    <small id="price-preview"></small>
  </label>
  <label>Stok
    <input type="number" name="stock" min="0" step="1" value="<?= e($p['stock']) ?>" required>
  </label>
  <div class="actions">
    <button class="btn primary">Simpan</button>
    <a class="btn" href="products.php">Batal</a>
  </div>
</form>
<?php require __DIR__ . '/footer.php'; ?>
