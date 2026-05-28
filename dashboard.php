<?php
session_start();
require_once 'koneksi.php';

// Proteksi halaman, pastikan user sudah login
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Logika jika form disubmit
if(isset($_POST['submit_artikel'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);

    $query = "INSERT INTO artikel (judul, konten) VALUES ('$judul', '$konten')";
    if(mysqli_query($koneksi, $query)) {
        $pesan_sukses = "Artikel berhasil diunggah!";
    } else {
        $pesan_error = "Gagal mengunggah artikel: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Backend - Kampus Print</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #ecf0f1; padding: 40px;">

<div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div>
            <a href="index.php" style="margin-right: 15px; text-decoration: none; color: #2980b9;">Lihat Website</a>
            <a href="proses_login.php?aksi=logout" style="color: red; text-decoration: none;">Logout</a>
        </div>
    </div>

    <h3>Upload File / Informasi Artikel</h3>
    <p style="margin-bottom: 20px; color: #7f8c8d;">Gunakan form di bawah ini untuk menambahkan artikel yang akan muncul di menu sidebar "List Artikel".</p>

    <?php if(isset($pesan_sukses)) echo "<p style='color: green; margin-bottom: 15px;'>$pesan_sukses</p>"; ?>
    <?php if(isset($pesan_error)) echo "<p style='color: red; margin-bottom: 15px;'>$pesan_error</p>"; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Judul Artikel / Informasi</label>
            <input type="text" name="judul" required placeholder="Contoh: Promo Cetak Skripsi Semester Ini">
        </div>
        <div class="form-group">
            <label>Konten / Detail (Teks)</label>
            <textarea name="konten" rows="8" required placeholder="Tuliskan isi informasi di sini..."></textarea>
        </div>
        <button type="submit" name="submit_artikel">Unggah Artikel</button>
    </form>
</div>

</body>
</html>