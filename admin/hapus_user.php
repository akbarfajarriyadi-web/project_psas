<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM user WHERE id='$id'");

header("Location: index.php");