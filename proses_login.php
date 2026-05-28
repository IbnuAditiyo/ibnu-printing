<?php
session_start();
require_once 'koneksi.php';

$aksi = $_GET['aksi'];

if($aksi == 'login') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
        } else {
            header("Location: login.php?pesan=gagal");
        }
    } else {
        header("Location: login.php?pesan=gagal");
    }

} elseif($aksi == 'daftar') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if(mysqli_query($koneksi, $query)) {
        header("Location: login.php?pesan=sukses_daftar");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} elseif($aksi == 'logout') {
    session_destroy();
    header("Location: index.php");
}
?>