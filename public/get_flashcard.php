<?php
session_start();
header('Content-Type: application/json');
require_once '../config.php';

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$result = mysqli_query($connection, "SELECT question, answer FROM flashcards ORDER BY RAND() LIMIT 1;");
$row = mysqli_fetch_assoc($result);

echo json_encode($row);