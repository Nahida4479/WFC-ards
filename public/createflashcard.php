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

$folder = mysqli_query($connection, "SELECT * FROM subjects WHERE user_id = '$user_id' AND id = '$subject_id'");
$folder_row = mysqli_fetch_assoc($folder);
?>

<?php
if (isset($_POST['save'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $save_flashcard = mysqli_query($connection, "INSERT INTO flashcards (question, answer, subject_id) VALUES ('$question', '$answer', '$subject_id');");
    header('Location: createflashcard.php?subject_id=' . $subject_id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WFC-ards</title>
</head>
<body>

<form method="POST">
    <input type="text" name="question" placeholder="Question">
    <input type="text" name="answer" placeholder="Answer">
    <button type="submit" name="save">Save flashcard</button>

</form>

<div class="flashcard_list">
<?php
    $flashcards = mysqli_query($connection, "SELECT * FROM flashcards WHERE subject_id = '$subject_id'");
    while ($card = mysqli_fetch_assoc($flashcards)) {
        echo "<p>" . htmlspecialchars($card['question']) . "-" . htmlspecialchars($card['answer']) . "</p>";
    }
?>
</div>

<?php 
    echo "<p>Folder" . htmlspecialchars($folder_row['name']) . "</p>";
?>
</body>
</html>