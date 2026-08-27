<?php
require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}


$result = mysqli_query($connection, "SELECT * FROM flashcards");

while ($row = mysqli_fetch_assoc($result)) {
    echo htmlspecialchars($row['question']) . " - " . htmlspecialchars($row['answer']) . "<br>";
}