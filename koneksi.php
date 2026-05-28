<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database Anda
$pass = "";     // Sesuaikan dengan password database Anda
$db   = "db_printing_kampus";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>