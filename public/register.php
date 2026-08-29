<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<form method="POST">
<input type="text" name="login" id="login_id">
<input type="password" name="password" id="password_id">
<button type="submit" id="submit_id">Register</button>

<script>
    const password_id = document.getElementById('password_id');

    if (password_id.length < 8) {
        alert('Password is too long')
        event.preventDefault();
    } 
</script>
<?php
require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')");
    if (!result) {
        echo "<script>alert('Error: Username already exists!);</script>";
    } else {
        echo "<script>alert('Sucess: Account created!');</script>";
    }
}

?>
</form>
</body>
</html>