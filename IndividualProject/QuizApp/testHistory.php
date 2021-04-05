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
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a><br>
    <h2> logged in as Lecturer: <?php echo $_SESSION["email"] . "<br><br>"; ?></h2>          <!--display email that is currently logged in -->
</head>
<body>

<?php

//select all scores from the database
$sql = "SELECT * FROM `score` ";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
// output all the scores from the database
    while($row = $result->fetch_assoc()) {
        echo "<p> Students email: " . $row["email_address"] . "<br> Quiz Name: " . $row["quiz_name"] . "<br> Score: " . $row["score"] . "/4 " .  "<br><br> </p>";
    }
} else {
    echo "0 results";
}

//close connection
$conn->close();
?>
<br><br>
<button id = "returnBtn" onclick="document.location='lecturer.php'">return to lecturer page</button>   <!-- return to lecturer options page-->
