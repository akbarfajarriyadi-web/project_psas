<?php
session_start();
include '../koneksi.php';


$id_user = $_SESSION['user_id'];


$data = mysqli_query($conn, "
    SELECT p.*, k.kendaraan_nama, k.kendaraan_nomor
    FROM pinjam p
    JOIN kendaraan k ON k.kendaraan_nomor = p.kendaraan_nomor
    WHERE p.user_id = '$id_user'
    ORDER BY p.pinjam_id DESC
");
?>
<hr><br>
<a href="user_index.php">
    <button>🏠 Index User</button>
</a>

<a href="pinjam_form.php">
    <button>📝 form pinjam</button>
</a>

<a href="riwayat.php">
    <button>📄 riwayat</button>
</a>
<br><br>
<h2>Riwayat Peminjaman</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Kendaraan</th>
        <th>No. Plat</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    <?php while ($d = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $d['kendaraan_nama']; ?></td>
        <td><?= $d['kendaraan_nomor']; ?></td>
        <td><?= $d['tgl_pinjam']; ?></td>
        <td><?= $d['tgl_kembali']; ?></td>
        <td>
            <?php
                if($d['pinjam_status'] == 1) echo "Ready";
                if($d['pinjam_status'] == 2) echo "Dipinjam";
            ?>
        </td>
    </tr>
    <?php } ?>
</table>