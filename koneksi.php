<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_rental_skanega";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Gagal terkoneksi: " . mysqli_connect_error());
}
?>