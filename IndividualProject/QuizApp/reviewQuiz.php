<?php
// Start the session
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="sheet.css">
    <meta charset="UTF-8">
    <title>Student</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a><br>
    <h2> logged in as Student: <?php echo $_SESSION["email"] . "<br><br>"; ?></h2>
</head>
<body>
<?php

// select the quiz the user has just taken from the database
$sql = "SELECT * FROM question WHERE quiz_name = '{$_SESSION["quizName"]}'";
$result = $conn -> query($sql);
$count = 0;
if ($result->num_rows > 0) {
// output data of each row so the user can see the questions and now can see the correct answers
    while($row = $result->fetch_assoc()) {
        $count= $count+1;
        echo "<h3> Question " . $count. ": " . $row["question"] .  "<br>" . " - Correct Answer: " . $row["question_answer"] . " " .  "<br><br></h3>" ;
    }
} else {
    echo "0 results";
}
//inform the user of their score
echo "<h3>You scored ". $_SESSION["score"] . "/4</h3>";

?>
<br>
<br>
<button id = "returnBtn" onclick="document.location='student.php'">return to student page</button>
