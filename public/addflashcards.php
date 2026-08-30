<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../config.php';
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$user_id = $_SESSION['user_id'];

if (isset($_POST['folder_button'])) {
    $folder_name = $_POST['folder_name'];
    mysqli_query($connection, "INSERT INTO subjects (name, user_id) VALUES ('$folder_name', '$user_id')");
    header('Location: addflashcards.php');
    exit;
}

$result = mysqli_query($connection, "SELECT * FROM subjects WHERE user_id = $user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add_flashcards</title>
    <link rel="stylesheet" href="addflashcards.css">
</head>
<body>
    

<?php
    echo "<div class=folder>" . "<h1 id=YourFolderText>Your Folders</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class=folder_a><a href='add_flashcards.php?subject_id=" . $row['id'] . "' class='folder_a_text'>" . htmlspecialchars($row['name']) . "</a></div>";
    }
    echo "</div>";


?>

<form method="POST" id="createfolder">
    <input type="text" name="folder_name" placeholder="Folder name" id="folder_name1">
    <button type="submit" name="folder_button" id="button">Create folder</button>

</form>

<script>
const folder_name1 = document.getElementById('folder_name1');
const button = document.getElementById('button')

button.addEventListener("click", () => {

if (folder_name1.value.length > 16) {
    alert("The name is too long (max 16)")
    event.preventDefault();
}

});

</script>

</body>
</html>