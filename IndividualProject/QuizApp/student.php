<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="sheet.css">
    <meta charset="UTF-8">
    <title>Student</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a>
</head>
<body>

<!-- page for displaying the options available as a student and allows them to select an option-->

<h2> logged in as Student: <?php echo $_SESSION["email"] . "<br><br>"; ?></h2>   <!-- Use session to display the users logged in email address -->

<button id = "quiz1" onclick="document.location='quizList.php'">Quiz List</button>
<br>
<br>
<button id = "viewScores" onclick="document.location='studentScores.php'">view previous scores</button>
<br>
<br>
<button id = "logout" onclick="document.location='logout.php'">logout</button>


</body>
</html>