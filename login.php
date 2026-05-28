<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $action == 'signup' ? 'Sign Up' : 'Sign In' ?> - Kampus Print</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">

<div style="background:#fff; padding:30px; border-radius:5px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:350px;">
    
    <?php
    if(isset($_GET['pesan'])) {
        if($_GET['pesan'] == "gagal") echo "<p style='color:red; margin-bottom:15px;'>Login gagal! Username atau password salah.</p>";
        if($_GET['pesan'] == "sukses_daftar") echo "<p style='color:green; margin-bottom:15px;'>Daftar sukses! Silakan login.</p>";
    }
    ?>

    <?php if($action == 'signup'): ?>
        <h2 style="margin-bottom:20px; text-align:center;">Sign Up Form</h2>
        <form action="proses_login.php?aksi=daftar" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" style="width:100%;">Daftar</button>
        </form>
        <p style="margin-top:15px; text-align:center;">Sudah punya akun? <a href="login.php">Sign In</a></p>
    
    <?php else: ?>
        <h2 style="margin-bottom:20px; text-align:center;">Sign In Form</h2>
        <form action="proses_login.php?aksi=login" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" style="width:100%;">Masuk</button>
        </form>
        <p style="margin-top:15px; text-align:center;">Belum punya akun? <a href="login.php?action=signup">Sign Up</a></p>
        <p style="margin-top:10px; text-align:center;"><a href="index.php">&laquo; Kembali ke Website</a></p>
    <?php endif; ?>
</div>

</body>
</html>