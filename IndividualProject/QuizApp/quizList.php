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
    <title>Quiz List</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a><br>

    <h2> logged in as Student: <?php echo $_SESSION["email"] . "<br><br>"; ?></h2>
    <h1>Quiz List</h1>
</head>
<body>


<?php

//select all available quizzes
$sql = "SELECT * FROM `quiz` WHERE quiz_name != ' '";
$result = $conn -> query($sql);

//display the available quizzes if there are any
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    echo "<h3> Quiz name: " . $row["quiz_name"] . " <br>Created by: " . $row["email_address"] . " " .  "<br><br></h3>";
    }
  } else {
   echo "0 results";
}


// define variables and set to empty values
 $quizChoiceErr =  "";
 $quizChoice =  "";

 //set quiz choice if user enters a value otherwise set error message
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["quizChoice"])) {
        $quizChoiceErr = "please enter the name of a valid quiz";
    } else {
        $quizChoice = test_input($_POST["quizChoice"]);
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<h2>please enter the name of the quiz you wish to take below</h2>
<br>
<p><span class="error">* required field</span></p>
<h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Quiz Choice: <input type="text" name="quizChoice">
    <span class="error"><?php echo $quizChoice;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form></h3>


<?php

//if user presses submit button
if(isset($_POST["submit"]))
{
    $query = "SELECT * FROM `quiz` WHERE quiz_name ='$quizChoice'";         //select the quiz the user chose from the database
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){                                                           //if user selected quiz exists in database
        $_SESSION['quizName'] = $quizChoice ;                               //set quiz name session variable
        header("Location: takeQuiz.php");                             // Redirect user to lecturer.php
    }else{
        echo "<h3>Quiz does not exist</h3>";                                //inform user they have made an invalid choice
    }
}

$conn->close();

?>

<button id = "returnBtn" onclick="document.location='student.php'">return to student page</button>

</body>
</html>
