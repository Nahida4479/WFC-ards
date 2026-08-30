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
    <title>WFC-ards</title>
    <link rel="stylesheet" href="addflashcards.css">
</head>
<body>
    
<section class="layout">

<div id="left_column">
<?php
    echo "<div class=folder>" . "<h1 id=YourFolderText>Your Folders</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class=folder_a><a href='createflashcard.php?subject_id=" . $row['id'] . "' class='folder_a_text'>" . htmlspecialchars($row['name']) . "</a></div>";
    }
    echo "</div>";


?>

<form method="POST" id="createfolder">
    <input type="text" name="folder_name" placeholder="Folder name" id="folder_name1">
    <div id="button_row">
    <button type="submit" name="folder_button" id="button">Create folder</button>
    <button id="toggle_delete_panel" type="button">🗑️ Delete a folder</button>
</div>

<div id="delete_panel" class="hidden">
    <h1 id="text_delete">Delete folder</h1>
<?php
$result2 = mysqli_query($connection, "SELECT * FROM subjects WHERE user_id = $user_id ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result2)) {
    echo "<a href='deletefolder.php?subject_id=" . $row['id'] . "' class='delete_icon'>🗑️" . htmlspecialchars($row['name']) . "</a>";
}
?>

</div>
</form>


</div>


<script>
// Delete panel display
const delete_panel = document.getElementById('delete_panel');
const toogle_delete_panel = document.getElementById("toggle_delete_panel");

toogle_delete_panel.addEventListener("click", () => {
    delete_panel.classList.toggle("hidden");
})





// Alert
const folder_name1 = document.getElementById('folder_name1');
const button = document.getElementById('button')

button.addEventListener("click", () => {

if (folder_name1.value.length > 16) {
    alert("The name is too long (max 16)")
    event.preventDefault();
}

if (folder_name1.value.length < 1) {
    alert("You didn't entered folder name")
    event.preventDefault();
}

});

</script>




<div id="howtouse">
<h1 id="htu_h1">How to use?</h1>
<div id="howtouse_1"> 
<p class="howtouse_step">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
Create new flashcard folder</p>

<p class="howtouse_step">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mouse-pointer"><path d="M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z"></path><path d="M13 13l6 6"></path></svg>    
Click name on your new folder</p>

<p class="howtouse_step">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
Create your new flashcard package</p>
<div>
</div>

</section>
</body>
</html>