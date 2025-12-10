<?php
include "../koneksi.php";

$id = $_GET['id'];


$q = mysqli_query($conn, "SELECT kendaraan_nomor FROM pinjam WHERE pinjam_id='$id'");
$data = mysqli_fetch_assoc($q);
$nomor = $data['kendaraan_nomor'];


mysqli_query($conn, "UPDATE pinjam SET pinjam_status = 2 WHERE pinjam_id='$id'");

mysqli_query($conn, "UPDATE kendaraan SET status = 2 WHERE kendaraan_nomor='$nomor'");

header("Location: pinjam_approval.php");
exit;
?>