<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}


$filter_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : "";

$query = "
    SELECT p.*, u.user_nama, k.kendaraan_nama
    FROM pinjam p
    JOIN user u ON p.user_id = u.user_id
    JOIN kendaraan k ON p.kendaraan_nomor = k.kendaraan_nomor
";

if ($filter_bulan != "") {
    $query .= " WHERE MONTH(p.tgl_pinjam) = '$filter_bulan' ";
}

$query .= " ORDER BY p.pinjam_id DESC";

$data = mysqli_query($conn, $query);


function statusText($s) {
    switch($s) {
        case 1: return "Ready";
        case 2: return "Dipinjam";
        case 3: return "Menunggu Approval";
        case 0: return "Ditolak";
        default: return "Unknown";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan / Riwayat Peminjaman</title>
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

<h2>Laporan / Riwayat Peminjaman</h2>


<form method="GET" action="">
    <label>Pilih Bulan:</label>
    <select name="bulan">
        <option value="">Semua</option>
        <?php 
        for ($i = 1; $i <= 12; $i++): 
            $selected = ($filter_bulan == $i) ? "selected" : "";
        ?>
            <option value="<?= $i ?>" <?= $selected ?>>
                <?= date("F", mktime(0,0,0,$i,1)) ?>
            </option>
        <?php endfor; ?>
    </select>

    <button type="submit">Filter</button>
</form>

<br>

<table border="1" cellpadding="7">
    <tr>
        <th>ID</th>
        <th>Nama User</th>
        <th>Kendaraan</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['pinjam_id'] ?></td>
        <td><?= $row['user_nama'] ?></td>
        <td><?= $row['kendaraan_nama'] ?></td>
        <td><?= $row['tgl_pinjam'] ?></td>
        <td><?= $row['tgl_kembali'] ?></td>
        <td><?= statusText($row['pinjam_status']) ?></td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>