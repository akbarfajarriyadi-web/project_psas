<?php
session_start();
include 'koneksi.php'; // pastikan file koneksi ada

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query admin berdasarkan username
$sql = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$admin = mysqli_fetch_assoc($sql);

// Cek apakah admin ditemukan
if ($admin) {
    
    // Jika database pakai password_hash()
    if (password_verify($password, $admin['password'])) {

        // Set session admin
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_id'] = $admin['id'];

        header("Location: admin/index_admin.php");
        exit();

    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }

} else {
    echo "<script>alert('Admin tidak ditemukan!'); window.location='login.php';</script>";
}

?>