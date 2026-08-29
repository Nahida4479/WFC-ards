<?php 
session_start();

// if (isset($_SESSION['user_id'])) {
//     echo 
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login_register.css">
</head>
<body>
    <div class="Register-Login">
<form method="POST">
        <p class="p_lr">Login</p>
    <div class="input_lr">
    <input type="text" name="login" id="login_id_l" class="login" placeholder="Username">
    <input type="password" name="password" id="password_id_l" class="password" placeholder="Password, your password is hashed :)">
    <button type="submit" id="submit_id_l" class="button">Login</button>
    <div>
            <p class="switch_link">Don't have an account? <a href="register.php">Register</a></p>

    </form>
</div>

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
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    echo "<script>alert('Login successful');</script>";
} else {
    echo "<script>alert('Invalid username or password');</script>";
}
}
?>
</body>
</html>