<?php
// Aktifkan session
session_start();

// Panggil koneksi database
include "koneksi.php";

@$pass = md5($_POST['password']);
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);

$login = mysqli_query($koneksi, "SELECT * FROM tuser WHERE username = '$username' AND password = '$password' AND status = 'Aktif'");

$data = mysqli_fetch_array($login);

// Uji jika username dan password ditemukan atau sesuai
if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['nama_pengguna'] = $data['nama_pengguna'];

    // Arahkan ke halaman admin
    header('Location: admin.php');
    exit;
} else {
    // Tampilkan alert dan redirect dengan JavaScript
    echo "<script>
        alert('Maaf, Login Gagal, Pastikan Username dan Password Anda Benar...!');
        window.location.href = 'index.php';
    </script>";
    exit;
}
?>
