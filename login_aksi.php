<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);

    // Set session user
    $_SESSION['username'] = $data['username'];
    $_SESSION['status']   = "login";

    header("location:index_user.php");
} else {
    echo "Login gagal! Username atau password salah.";
}
?>