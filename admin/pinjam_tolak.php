<?php
include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "UPDATE pinjam SET pinjam_status = 0 WHERE pinjam_id='$id'");

header("Location: pinjam_approval.php");
exit;
?>