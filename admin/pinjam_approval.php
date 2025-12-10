<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}


$data = mysqli_query($conn, "
    SELECT p.*, u.user_nama, k.kendaraan_nama
    FROM pinjam p
    JOIN user u ON p.user_id = u.user_id
    JOIN kendaraan k ON p.kendaraan_nomor = k.kendaraan_nomor
    WHERE p.pinjam_status = 3
    ORDER BY p.pinjam_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approval Peminjaman</title>
</head>
<body>
<a href="index_admin.php">
    <button>🏠 Index Admin</button>
</a>

<a href="pinjam_approval.php">
    <button>✔ Approval Peminjaman</button>
</a>

<a href="laporan.php">
    <button>📄 Laporan</button>
</a>
<hr>

<h2>Daftar Peminjaman Menunggu Approval</h2>

<table border="1" cellpadding="7">
    <tr>
        <th>ID</th>
        <th>Nama User</th>
        <th>Kendaraan</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['pinjam_id'] ?></td>
        <td><?= $row['user_nama'] ?></td>
        <td><?= $row['kendaraan_nama'] ?></td>
        <td><?= $row['tgl_pinjam'] ?></td>
        <td><?= $row['tgl_kembali'] ?></td>
        <td>
            <a href="pinjam_approve.php?id=<?= $row['pinjam_id'] ?>">Approve</a> |
            <a href="pinjam_tolak.php?id=<?= $row['pinjam_id'] ?>">Tolak</a>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>