<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <script>
        function changeAction() {
            const role = document.getElementById("role").value;
            const form = document.getElementById("loginForm");

            if (role === "admin") {
                form.action = "login_admin_aksi.php";
            } else {
                form.action = "login_aksi.php";
            }
        }
    </script>
</head>
<body>

<h2>Login</h2>

<form method="POST" id="loginForm" action="login_aksi.php">
    <label>Login sebagai:</label><br>
    <select id="role" name="role" onchange="changeAction()" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <br><br>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>