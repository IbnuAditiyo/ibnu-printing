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
    
    // Konfigurasi Upload File
    $nama_file = $_FILES['file_info']['name'];
    $ukuran_file = $_FILES['file_info']['size'];
    $error_file = $_FILES['file_info']['error'];
    $tmp_file = $_FILES['file_info']['tmp_name'];
    
    $file_final = null;

    // Jika ada file yang diunggah
    if($nama_file != '') {
        $ekstensi_diperbolehkan = array('pdf', 'doc', 'docx', 'jpg', 'png');
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        
        // Membuat nama file baru yang unik agar tidak bentrok
        $file_final = time() . '_' . $nama_file;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if($ukuran_file < 5242880) { // Batas maksimal 5MB
                // Buat folder uploads jika belum ada
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                
                // Pindahkan file dari folder sementara ke folder tujuan
                move_uploaded_file($tmp_file, 'uploads/' . $file_final);
            } else {
                $pesan_error = "Gagal mengunggah: Ukuran file terlalu besar (Maksimal 5MB).";
            }
        } else {
            $pesan_error = "Gagal mengunggah: Ekstensi file tidak diizinkan (Hanya PDF, DOC, DOCX, JPG, PNG).";
        }
    }

    // Jika tidak ada error dari validasi file, masukkan ke database
    if(!isset($pesan_error)) {
        $query = "INSERT INTO artikel (judul, konten, file_pdf) VALUES ('$judul', '$konten', '$file_final')";
        if(mysqli_query($koneksi, $query)) {
            $pesan_sukses = "Informasi dan file berhasil diunggah!";
        } else {
            $pesan_error = "Gagal menyimpan ke database: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Backend - Ibnu Printing</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #ecf0f1; padding: 40px;">

<div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 5px;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div>
            <a href="index.php" style="margin-right: 15px; text-decoration: none; color: #2980b9; font-weight: bold;">Lihat Website</a>
            <a href="proses_login.php?aksi=logout" style="color: red; text-decoration: none; font-weight: bold;">Logout</a>
        </div>
    </div>

    <h3>Upload File & Informasi Artikel</h3>
    <p style="margin-bottom: 20px; color: #7f8c8d;">Gunakan form di bawah ini untuk menambahkan berita, artikel, atau dokumen informasi cetak.</p>

    <?php if(isset($pesan_sukses)) echo "<p style='color: green; background: #e8f8f5; padding: 10px; border-left: 5px solid green; margin-bottom: 15px;'>$pesan_sukses</p>"; ?>
    <?php if(isset($pesan_error)) echo "<p style='color: red; background: #fdedec; padding: 10px; border-left: 5px solid red; margin-bottom: 15px;'>$pesan_error</p>"; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul Artikel / Informasi</label>
            <input type="text" name="judul" required placeholder="Contoh: Modul Panduan Format Skripsi & Tugas Akhir">
        </div>
        <div class="form-group">
            <label>Konten / Deskripsi Singkat</label>
            <textarea name="konten" rows="6" required placeholder="Tuliskan isi atau deskripsi informasi di sini..."></textarea>
        </div>
        <div class="form-group" style="background: #f9f9f9; padding: 15px; border: 1px dashed #ccc; border-radius: 4px;">
            <label>Lampiran File Informasi (PDF, DOCX, atau Gambar)</label>
            <input type="file" name="file_info" style="border: none; padding: 5px 0;">
            <small style="color: #e74c3c; display: block; margin-top: 5px;">*Opsional. Maksimal ukuran file 5MB.</small>
        </div>
        <button type="submit" name="submit_artikel" style="margin-top: 10px;">Unggah Informasi</button>
    </form>
</div>

</body>
</html>