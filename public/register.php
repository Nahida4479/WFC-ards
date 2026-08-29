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

</form>
<script>
    const password_id = document.getElementById('password_id');
    const login_id = document.getElementById('login_id')
    const submit_id = document.getElementById('submit_id');
    const form = document.querySelector('form')

    document.querySelector('form').addEventListener("submit", (event) => {
    if (password_id.value.length < 1 || login_id.value.length < 1) {
        alert("The registration form is incomplete")
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
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $result = mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')");
        echo "<script>alert('Success: Account created!');</script>";
    } catch (mysqli_sql_exception $e) {
    echo "<script>alert('Error: Username already exists!');</script>";
}   
}

?>
</form>
</body>
</html>