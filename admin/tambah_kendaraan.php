<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['save'])) {
    $nama   = $_POST['nama'];
    $nomor  = $_POST['nomor'];

    
    $status = 1; 

    mysqli_query($conn, 
        "INSERT INTO kendaraan (kendaraan_nama, kendaraan_nomor, status) 
         VALUES ('$nama', '$nomor', '$status')");

    header("Location: kendaraan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kendaraan</title>
</head>
<body>

<h2>Tambah Kendaraan</h2>

<form method="POST">
    <label>Nama Kendaraan:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Nomor Plat Kendaraan:</label><br>
    <input type="text" name="nomor" required><br><br>

    <button type="submit" name="save">Simpan Kendaraan</button>
</form>

</body>
</html>