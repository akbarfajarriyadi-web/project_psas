<?php
session_start();
include "../koneksi.php";


if (!isset($_SESSION['user_id']) || $_SESSION['user_status'] != 2) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($user_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - Rental Skanega</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 25px;
        }
        h2 {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #555;
        }
        th {
            background: #222;
            color: white;
            padding: 10px;
        }
        td {
            padding: 8px;
            text-align: center;
        }
        a.btn {
            padding: 6px 12px;
            background: #4CAF50;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        a.btn:hover {
            background: #45a049;
        }
        .logout {
            float: right;
            margin-top: -40px;
        }
        .btn-pinjam {
    display: inline-block;
    padding: 8px 14px;
    background: #1e90ff;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}
.btn-pinjam:hover {
    background: #0c6cd4;
}
    </style>
</head>
<body>

<h2>Selamat Datang, <?php echo $user['user_nama']; ?> 👋</h2>
<p>Anda login sebagai <b>User</b>.</p>

<a class="btn logout" style="background:#e63946;" href="../logout.php">Logout</a>

<hr><br>

<h3>Daftar Kendaraan yang Tersedia</h3>

<?php

$kendaraan_query = mysqli_query($koneksi, "
    SELECT * FROM kendaraan 
    WHERE kendaraan_nomor NOT IN 
    (SELECT kendaraan_nomor FROM pinjam WHERE pinjam_status = 2)
");
?>

<table>
    <tr>
        <th>Nomor Kendaraan</th>
        <th>Nama Kendaraan</th>
        <th>Tipe</th>
        <th>Harga/Hari</th>
        <th>Aksi</th>
    </tr>

    <?php while ($k = mysqli_fetch_assoc($kendaraan_query)) { ?>
    <tr>
        <td><?php echo $k['kendaraan_nomor']; ?></td>
        <td><?php echo $k['kendaraan_nama']; ?></td>
        <td><?php echo $k['kendaraan_tipe']; ?></td>
        <td>Rp <?php echo number_format($k['kendaraan_harga_perhari']); ?></td>
        <td>
            <a class="btn" href="pinjam_form.php?nomor=<?php echo $k['kendaraan_nomor']; ?>">Pinjam</a>
        </td>
    </tr>
    <?php } ?>

</table>

<br><br>

<h3>Riwayat Peminjaman Anda</h3>

<?php
$pinjam_query = mysqli_query($koneksi, "
    SELECT pinjam.*, kendaraan.kendaraan_nama
    FROM pinjam
    JOIN kendaraan ON pinjam.kendaraan_nomor = kendaraan.kendaraan_nomor
    WHERE user_id='$user_id'
");
?>

<table>
    <tr>
        <th>ID Pinjam</th>
        <th>Kendaraan</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
    </tr>

    <?php while ($p = mysqli_fetch_assoc($pinjam_query)) { ?>
    <tr>
        <td><?php echo $p['pinjam_id']; ?></td>
        <td><?php echo $p['kendaraan_nama']; ?></td>
        <td><?php echo $p['tgl_pinjam']; ?></td>
        <td><?php echo $p['tgl_kembali']; ?></td>
        <td>
            <?php 
                echo ($p['pinjam_status'] == 1) ? "Ready" : "Dipinjam";
            ?>
        </td>
    </tr>
    <?php } ?>

</table>

<a href="pinjam_form.php?id=<?= $d['id']; ?>" 
   class="btn-pinjam">
   Pinjam
</a>

</body>
</html>