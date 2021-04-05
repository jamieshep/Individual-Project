<?php
// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">


<!-- page for displaying the options available as a lecturer and allows them to select an option-->

<head>
    <link rel="stylesheet" href="sheet.css">
    <meta charset="UTF-8">
    <title>Lecturer</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a>
</head>
<body>

<h1>logged in as Lecturer: <?php echo $_SESSION["email"] . "<br><br>"; ?></h1>

<div>
    <br>
    <button id = "viewHistoryButton" onclick="document.location='testHistory.php'">view student results</button>
    <br>
    <button id = "makeQuizButton" onclick="document.location='createQuiz.php'">Create a quiz here</button>
    <br>
    <button id = "logout" onclick="document.location='logout.php'">logout</button>
</div>

</body>
</html>