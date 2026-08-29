<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form method="POST">
    <input type="text" name="login" id="login_id_l">
    <input type="password" name="password" id="password_id_l">
    <button type="submit" id="submit_id_l">Login</button>
</form>
    <script>
    const password_id = document.getElementById('password_id_l');
    const login_id = document.getElementById('login_id_l')
    const submit_id = document.getElementById('submit_id_l');
    const form = document.querySelector('form')

    document.querySelector('form').addEventListener("submit", (event) => {
    if (password_id.value.length < 1 || login_id.value.length < 1) {
        alert("The login form is incomplete")
        event.preventDefault();
    } else if (password_id.value.length < 8) {
        alert('Password is too short')
        event.preventDefault();
    } 
    });
</script>
<?php
require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST["login"];
    $password = $_POST["password"];

$result = mysqli_query($connection, "SELECT * FROM users WHERE login = '$login';");
$row = mysqli_fetch_assoc($result);

if ($row && password_verify($password, $row['password']) ) {
    echo "<script>alert('Login successful');</script>";
} else {
    echo "<script>alert('Invalid username or password');</script>";
}
}
?>
</body>
</html>