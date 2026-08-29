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
?>

<header>
    <?php if (isset($_SESSION['login'])) {
        echo "<p>Logged in as: " . htmlspecialchars($_SESSION['login']) . "</p>";
     } else {
        echo '<p><a href=login.php>Login</a></p>';
    }
    ?>
</header>

<section id="section">
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
</section>

<div id="npbutton">
<button id="previous">Previous</button>
<button id="next">Next</button>
    </div>

<script>
    const card = document.getElementById('flashcard_background');
    const inner = document.querySelector('.flashcard_inner');
    card.addEventListener('click', () => {
        if (inner.classList.contains('flipped')) {
            inner.classList.remove('flipped');
            card.style.backgroundColor = 'rgb(255, 147, 6)'
        } else {
            inner.classList.add('flipped');
            card.style.backgroundColor = '#256db4'
        }
    })

    let history_flashcards = [];
document.getElementById('next').addEventListener('click', function() {
    history_flashcards.push({
        question: document.getElementById('question').textContent,
        answer: document.getElementById('answer').textContent
    });

    fetch('get_flashcard.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);

        document.getElementById('question').textContent = data.question;
        document.getElementById('answer').textContent = data.answer;
        inner.classList.remove('flipped');
        })
});

document.getElementById('previous').addEventListener('click', () => {
    if (history_flashcards.length > 0) {
        const previous_card = history_flashcards.pop();
        inner.classList.remove('flipped');
        card.style.backgroundColor = 'rgb(255, 147, 6)'
        document.getElementById('question').textContent = previous_card.question;
        document.getElementById('answer').textContent = previous_card.answer;
    }
});
</script>
</body>
</html>

