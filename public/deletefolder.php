<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$subject_id = $_GET['subject_id'];
$user_id = $_SESSION['user_id'];

$delete_flashcard = mysqli_query($connection, "DELETE FROM flashcards WHERE subject_id = '$subject_id'");
$folder_id = mysqli_query($connection, "DELETE FROM subjects WHERE user_id = '$user_id' AND id = '$subject_id' ");

header('Location: addflashcards.php');
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    
</body>
</html>