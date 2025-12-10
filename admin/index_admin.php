<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}


$userQuery = mysqli_query($conn, "SELECT * FROM user");

$availQuery = mysqli_query($conn, "SELECT * FROM kendaraan WHERE status='available'");


$pinjamQuery = mysqli_query($conn, "
    SELECT p.*, k.nama_kendaraan, u.nama 
    FROM peminjaman p
    JOIN kendaraan k ON p.kendaraan_id = k.id
    JOIN user u ON p.user_id = u.id
    WHERE p.status='dipinjam'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px }
        table, th, td { border: 1px solid #000; padding: 7px }
        h2 { margin-top: 40px }
        .btn { padding: 8px 12px; background: #333; color: #fff; text-decoration: none; border-radius: 4px }
        .btn:hover { background: #555 }
    </style>
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

<h1>Dashboard Admin</h1>

<hr>

<h2>List User</h2>
<a href="tambah_user.php" class="btn">+ Tambah User</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    <?php while ($u = mysqli_fetch_assoc($userQuery)) { ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nama'] ?></td>
        <td><?= $u['username'] ?></td>
        <td><?= $u['role'] ?></td>
        <td>
            <a href="edit_user.php?id=<?= $u['id'] ?>">Edit</a> |
            <a href="hapus_user.php?id=<?= $u['id'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>

<hr>

<h2>Kendaraan Available</h2>
<a href="tambah_kendaraan.php" class="btn">+ Tambah Kendaraan</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Kendaraan</th>
        <th>Jenis</th>
        <th>Status</th>
    </tr>

    <?php while ($k = mysqli_fetch_assoc($availQuery)) { ?>
    <tr>
        <td><?= $k['id'] ?></td>
        <td><?= $k['nama_kendaraan'] ?></td>
        <td><?= $k['jenis'] ?></td>
        <td><?= $k['status'] ?></td>
    </tr>
    <?php } ?>

</table>

<hr>

<h2>Kendaraan Sedang Dipinjam</h2>
<table>
    <tr>
        <th>ID Pinjam</th>
        <th>User</th>
        <th>Kendaraan</th>
        <th>Tanggal Pinjam</th>
        <th>Aksi</th>
    </tr>

    <?php while ($p = mysqli_fetch_assoc($pinjamQuery)) { ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['nama_kendaraan'] ?></td>
        <td><?= $p['tgl_pinjam'] ?></td>
        <td>
            <a href="proses_kembali.php?id=<?= $p['id'] ?>" class="btn">Kembalikan</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>