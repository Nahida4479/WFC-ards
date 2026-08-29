<?php 
session_start();
?>

<?php
$error = "";
require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $result = mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')");
        header('Location: index.php');
        exit;
    } catch (mysqli_sql_exception $e) {
    $error = "Username already exists";
}   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style_login_register.css">
</head>
<body>

    <div class="Register-Login">
<form method="POST">
       <p class="p_lr">Register</p>
    <div class="input_lr">
<input type="text" name="login" id="login_id" class="login" placeholder="Username">
<input type="password" name="password" id="password_id" class="password" placeholder="Password, your password is hashed :)">
<button type="submit" id="submit_id" class="button">Register</button>
<div>
    <p id="error_element" class="error"><?php echo htmlspecialchars($error);?></p>
    <p class="switch_link">You have an account? <a href="login.php">Login</a></p>

</form>
</div>

<script>
    const error = document.getElementById('error_element');
    const password_id = document.getElementById('password_id');
    const login_id = document.getElementById('login_id')
    const submit_id = document.getElementById('submit_id');
    const form = document.querySelector('form')

    document.querySelector('form').addEventListener("submit", (event) => {
    if (password_id.value.length < 1 || login_id.value.length < 1) {
        error.textContent = "The registration form is incomplete"
        event.preventDefault();
    } else if (password_id.value.length < 8) {
        error.textContent = "Password is too short"
        event.preventDefault();
    } else {
        error.textContent = "";
    }
    });
</script>
</form>
</body>
</html>