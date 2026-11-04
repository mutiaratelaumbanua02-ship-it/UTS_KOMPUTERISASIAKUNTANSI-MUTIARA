<?php
require_once __DIR__ . '/db.php';
if (!empty($_SESSION['admin'])) redirect('dashboard.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $u = $stmt->fetch();

    if ($u && password_verify($password, $u['password']) && in_array(strtolower($u['username']), $ADMIN_USERS, true)) {
        session_regenerate_id(true);
        $_SESSION['admin'] = ['id' => $u['id'], 'username' => $u['username']];
        flash('Selamat datang, ' . $u['username'] . '!');
        redirect('dashboard.php');
    }
    $error = 'Username atau password salah, atau akun ini bukan admin.';
}
$f = flash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - Kelontong Store</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="login-page">
  <div class="login-card">
    <div class="login-logo">🛒</div>
    <h1>Kelontong Store</h1>
    <p class="muted">Login Admin</p>
    <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
    <?php if ($f): ?><div class="alert <?= e($f['type']) ?>"><?= e($f['msg']) ?></div><?php endif; ?>
    <form method="post" class="form">
      <?= csrf_field() ?>
      <label>Username
        <input type="text" name="username" value="<?= e($_POST['username'] ?? '') ?>" required autofocus>
      </label>
      <label>Password
        <input type="password" name="password" id="password" required>
      </label>
      <label class="check"><input type="checkbox" id="show-pass"> Tampilkan password</label>
      <button class="btn primary block">Masuk</button>
    </form>
  </div>
<script src="../js/admin.js"></script>
</body>
</html>
