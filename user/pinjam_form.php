<?php
session_start();
include '../koneksi.php';

if($_SESSION['role'] != "user"){
    header("Location: ../auth/login.php");
    exit;
}

$id_kendaraan = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kendaraan WHERE id='$id_kendaraan'");
$kendaraan = mysqli_fetch_assoc($data);
?>

<h2>Form Peminjaman Kendaraan</h2>

<p><b>Kendaraan:</b> <?= $kendaraan['nama']; ?> (<?= $kendaraan['noplat']; ?>)</p>
<br>

<form method="POST" action="aksi_pinjam.php">

    <input type="hidden" name="id_kendaraan" value="<?= $kendaraan['id']; ?>">

    <label>Keperluan</label><br>
    <input type="text" name="keperluan" required><br><br>

    <label>Tanggal Pinjam</label><br>
    <input type="date" name="tgl_pinjam" required><br><br>

    <label>Tanggal Kembali (Perkiraan)</label><br>
    <input type="date" name="tgl_kembali" required><br><br>

    <button type="submit">Ajukan Peminjaman</button>

</form>