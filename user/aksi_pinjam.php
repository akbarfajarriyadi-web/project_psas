<?php
session_start();
include '../koneksi.php';

$id_user       = $_SESSION['id'];
$id_kendaraan  = $_POST['id_kendaraan'];
$keperluan     = $_POST['keperluan'];
$tgl_pinjam    = $_POST['tgl_pinjam'];
$tgl_kembali   = $_POST['tgl_kembali'];

mysqli_query($conn, "INSERT INTO peminjaman 
VALUES (NULL, '$id_user', '$id_kendaraan', '$keperluan', '$tgl_pinjam', '$tgl_kembali', 'dipinjam')");

mysqli_query($conn, "UPDATE kendaraan SET status='dipinjam' WHERE id='$id_kendaraan'");

header("Location: riwayat.php");
?>