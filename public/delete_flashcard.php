<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$userid = $_SESSION['user_id'];
$subjectid = $_GET['subject_id'];
$flashcard_id = $_GET['flashcard_id'];
$delete = mysqli_query($connection, "DELETE FROM flashcards WHERE subject_id = '$subjectid' AND id = '$flashcard_id'");

header('Location: createflashcard.php?subject_id=' . $subjectid);
exit;
?>