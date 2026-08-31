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
    <link rel="stylesheet" href="createform.css">
</head>
<body>

<header>
<h1>Adding to folder: <?php echo $folder_row['name']; ?></h1>
</header>   

<div id="form">
<form method="POST">
    <div class="q_and_a">
        <div class="background" id="qu_question">
        <h1 style="color: white;">Add flashcard question</h1>
    <input type="text" name="question" placeholder="Question" id="question">
    <div class="flashcard_background">
        <p id="text_question"></p>
</div>
</div>


<div id="fl_creted_div">
<div id="fl_created">
    <h1>Your flashcards</h1>
<?php
    $flashcards = mysqli_query($connection, "SELECT * FROM flashcards WHERE subject_id = '$subject_id'");
    while ($card = mysqli_fetch_assoc($flashcards)) {
        echo "<p>" . htmlspecialchars($card['question']) . "-" . htmlspecialchars($card['answer']) . " <a href=delete_flashcard.php?flashcard_id=" . card['id'] . "&subject_id=" . $subject_id . "'>🗑️</a></p>";
    }
?>
</div>
    <button type="submit" name="save" id="fl_save">Save flashcard</button>

</div>
    <div class="background">
    <h1 style="color: white;">Add flashcard answer</h1>
    <input type="text" name="answer" placeholder="Answer" id="answer">
    
    <div class="flashcard_background" id="fl_answer">
        <p id="text_answer"></p>
</div>
</div>

</div>


</div id="fl_save_div"> 
    
</form>
</div>

<div class="flashcard_list">
</div>


<script>
const question_preview = document.getElementById('question');
const text_answer = document.getElementById('text_answer');
const answer_preview = document.getElementById('answer');
const text_question = document.getElementById('text_question');
const save = document.getElementById('fl_save')

question_preview.addEventListener('input', () => {
    text_question.textContent = question_preview.value;
});

answer_preview.addEventListener('input', () => {
    text_answer.textContent = answer_preview.value;
})

save.addEventListener('click', (event) => {
if (question_preview.value.length < 1) {
    alert("The question is empty");
    event.preventDefault();
} else if (answer_preview.value.length < 1) {
    alert("The answer is empty")
    event.preventDefault();
} 
});






</script>
</body>
</html>