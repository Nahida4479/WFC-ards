<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WFC-ards</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$result = mysqli_query($connection, "SELECT question, answer FROM flashcards ORDER BY RAND() LIMIT 1;");

$row = mysqli_fetch_assoc($result);
    echo '<div class="flashcard_background"><p class="flashcard_text">' .htmlspecialchars($row['question']) . '</p></div>';


?>

<div class="flashcard_background" id="flashcard_background">
    <div class="flashcard_inner">
        <div class="flashcard_front">
            <p id="question"><?php echo htmlspecialchars($row['question']); ?> </p>
        </div>
            <div class="flashcard_back">
                <p id="answer"><?php echo htmlspecialchars($row['answer']); ?> </p>
        </div>
    </div>
</div>

</body>
</html>

