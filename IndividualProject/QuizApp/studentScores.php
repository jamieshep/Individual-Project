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

$sql = "SELECT * FROM `score` WHERE email_address = '{$_SESSION["email"]}'";           //select the student scores that match the email address signed in with
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
// output data of each row so student can see their scores
    while($row = $result->fetch_assoc()) {
        echo "<p>"."Students email: " . $row["email_address"] . "<br>" ." Quiz Name: " . $row["quiz_name"] . "<br> Score: " . $row["score"] . "/4 " .  "<br><br>" . "</p>";
    }
} else {
    echo "<h3> You have not taken a quiz yet</h3>";                           //if no quizzes have been taken yet inform the user
}

//close connection
$conn->close();
?>
<br><br>
<button id = "returnBtn" onclick="document.location='student.php'">return to student page</button>
</body>
</html>