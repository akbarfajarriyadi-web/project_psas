<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    update
    if ($_POST['password'] != "") {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE user SET 
            nama='$nama',
            username='$username',
            password='$password',
            role='$role'
            WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE user SET 
            nama='$nama',
            username='$username',
            role='$role'
            WHERE id='$id'");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $user['nama'] ?>" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br><br>

    <label>Password (kosongkan jika tidak diubah):</label><br>
    <input type="password" name="password"><br><br>

    <label>Role:</label><br>
    <select name="role">
        <option value="user" <?= $user['role']=="user" ? "selected" : "" ?>>User</option>
        <option value="admin" <?= $user['role']=="admin" ? "selected" : "" ?>>Admin</option>
    </select><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>