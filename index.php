<?php
require_once 'koneksi.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - Jasa Printing Kampus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <header>
        <div class="logo-area">
            <img src="assets/images/logoo.png" alt="Ibnu Printing Logo">
        </div>
        <div class="company-title">
            <h1>Ibnu Printing</h1>
        </div>
    </header>

    <nav class="top-nav">
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=profile">Profile</a></li>
            <li><a href="index.php?page=visi_misi">Visi dan Misi</a></li>
            <li><a href="index.php?page=produk">Produk Kami</a></li>
            <li><a href="index.php?page=kontak">Kontak</a></li>
            <li><a href="index.php?page=about">About Us</a></li>
        </ul>
    </nav>

    <div class="main-wrapper">
        
        <aside class="sidebar">
            <ul>
                <li class="dropdown">
                    <a href="#">Artikel &#9662;</a>
                    <div class="dropdown-content">
                        <a href="index.php?page=list_artikel">List Artikel</a>
                    </div>
                </li>
                <li><a href="index.php?page=gallery">Galeri Foto</a></li>
                <li><a href="index.php?page=klien">Daftar Klien</a></li>
                <li><a href="login.php">Login (Sign In)</a></li>
                <li><a href="login.php?action=signup">Sign Up</a></li>
            </ul>
        </aside>

        <main class="content">
            <?php
            switch ($page) {
                case 'home':
                    echo "<div class='banner'>
                            <h2>Selamat Datang di Ibnu Printing</h2>
                            <p>Solusi cetak dokumen cepat, murah, dan berkualitas tinggi untuk mahasiswa.</p>
                          </div>";
                    echo "<p>Kami adalah penyedia jasa percetakan terpercaya di area Universitas Indo Global Mandiri. Kami mengerti bahwa tenggat waktu tugas dan makalah sangat berharga, sehingga kami menjamin proses cetak yang cepat tanpa mengurangi kualitas.</p>";
                    break;

                case 'profile':
                    echo "<h2>Profile & Kelebihan Kami</h2>";
                    echo "<p>Ibnu Printing telah melayani puluhan mahasiswa dan dosen. <strong>Kelebihan kami:</strong></p>";
                    echo "<ul class='service-list'>
                            <li>Proses sangat cepat, bisa ditunggu.</li>
                            <li>Kualitas warna tajam berkat penggunaan printer <strong>Epson L3210</strong> original.</li>
                            <li>Harga mahasiswa yang bersahabat.</li>
                          </ul>";
                    break;

                case 'visi_misi':
                    echo "<h2>Visi dan Misi</h2>";
                    echo "<h3>Visi:</h3>";
                    echo "<p>Menjadi mitra terbaik mahasiswa dan akademisi dalam memenuhi kebutuhan cetak dokumen secara profesional, cepat, dan ekonom.</p><br>";
                    echo "<h3>Misi:</h3>";
                    echo "<ul class='service-list'>
                            <li>Memberikan pelayanan yang prima dan ramah kepada setiap pelanggan.</li>
                            <li>Menggunakan perangkat cetak berstandar tinggi untuk hasil optimal.</li>
                            <li>Terus berinovasi dalam layanan jilid dan variasi kertas.</li>
                          </ul>";
                    break;

                case 'produk':
                    echo "<h2>Produk & Jasa Kami</h2>";
                    echo "<ul class='service-list'>
                            <li>Print Warna & Hitam Putih (A4, F4)</li>
                            <li>Fotokopi Dokumen</li>
                            <li>Jilid Makalah</li>
                            <li>Cetak Pas Foto & Brosur</li>
                            <li>Scan Dokumen Resolusi Tinggi</li>
                          </ul>";
                    break;

                case 'kontak':
                    echo "<h2>Kontak Kami</h2>";
                    echo "<p>Kunjungi toko kami atau hubungi kami untuk pemesanan cetak *online*:</p>";
                    echo "<ul class='service-list'>
                            <li><strong>Alamat:</strong> Jl. Ariodillah III, Area Kampus (Belakang Universitas Indo Global Mandiri)</li>
                            <li><strong>WhatsApp:</strong> 0812-7670-5884</li>
                            <li><strong>Email:</strong> ibnuadityo45@gmail.com</li>
                          </ul>";
                    break;

                case 'about':
                    echo "<h2>About Us & Sejarah</h2>";
                    echo "<p>Berdiri sejak tahun 2026, Ibnu Printing dimulai dari sebuah usaha skala kecil yang bertujuan membantu teman-teman mahasiswa mengejar *deadline* tugas kuliah dan tugas akhir.</p>";
                    echo "<p>Seiring berjalannya waktu, dedikasi kami terhadap kualitas dan ketepatan waktu membuat kami dipercaya oleh berbagai mahasiswa dan civitas akademika.</p>";
                    break;

                case 'gallery':
                    echo "<h2>Galeri Foto</h2>";
                    echo "<div class='gallery-grid'>
                            <img src='assets/images/galeri1.jpeg' alt='Galeri 1' class='gallery-item'>
                            <img src='assets/images/galeri2.jpeg' alt='Galeri 2' class='gallery-item'>
                            <img src='assets/images/galeri3.jpeg' alt='Galeri 3' class='gallery-item'>
                          </div>";
                    break;

                case 'klien':
                    echo "<h2>Daftar Klien Kami</h2>";
                    echo "<ul class='client-list'>
                            <li>Mahasiswa Fakultas Ilmu Komputer & Sains</li>
                            <li>Himpunan Mahasiswa Teknik Informatika (HMIF)</li>
                            <li>BEM Universitas Indo Global Mandiri</li>
                            <li>Unit Kegiatan Mahasiswa (UKM)</li>
                          </ul>";
                    break;

                case 'list_artikel':
                    echo "<h2>Daftar Artikel & File Informasi</h2>";
                    echo "<p style='margin-bottom: 20px;'>Informasi akademis, tips pencetakan, dan unduhan dokumen penting:</p>";
                    
                    $query = "SELECT * FROM artikel ORDER BY id DESC";
                    $result = mysqli_query($koneksi, $query);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div style='border:1px solid #ddd; border-radius: 5px; background: #fafafa; padding:20px; margin-bottom:20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);'>";
                            echo "<h3 style='color: #2c3e50; margin-bottom: 5px;'>".htmlspecialchars($row['judul'])."</h3>";
                            echo "<small style='color: #95a5a6;'>Diupload pada: ".$row['tanggal_upload']."</small>";
                            echo "<p style='margin-top:12px; margin-bottom: 15px; color: #555; text-align: justify;'>".nl2br(htmlspecialchars($row['konten']))."</p>";
                            
                            // Logika mendeteksi keberadaan file fisik
                            if(!empty($row['file_pdf'])) {
                                echo "<div style='background: #eaf2f8; padding: 10px 15px; border-radius: 4px; display: inline-block;'>";
                                echo "📂 <strong>Lampiran Dokumen:</strong> ";
                                echo "<a href='uploads/".htmlspecialchars($row['file_pdf'])."' target='_blank' style='color: #2980b9; text-decoration: underline; font-weight: bold;'>Lihat / Unduh File</a>";
                                echo "</div>";
                            }
                            
                            echo "</div>";
                        }
                    } else {
                        echo "<p style='color: #7f8c8d; font-style: italic;'>Belum ada artikel atau file informasi yang diunggah oleh admin.</p>";
                    }
                    break;

                default:
                    echo "<h2>Halaman Tidak Ditemukan</h2>";
                    break;
            }
            ?>
        </main>
    </div>

    <footer>
        <p>Design by : Ibnu Aditiyo</p>
    </footer>
</div>

</body>
</html>