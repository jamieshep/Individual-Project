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
<h1>Please complete the Quiz</h1>

<?php
// define variables and set to empty values
$q1Err = $q2Err = $q3Err = $q4Err =  "";
$q1Choice = $q2Choice = $q3Choice = $q4Choice =  "";

//take user input for answers, if left blank then set error message
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["Q1choice"])) {
        $q1Err = "please elect an answer for question one";
    } else {
        $q1Choice = test_input($_POST["Q1choice"]);
    }

    if (empty($_POST["Q2choice"])) {
        $q2Err = "please elect an answer for question two";
    } else {
        $q2Choice = test_input($_POST["Q2choice"]);
    }

    if (empty($_POST["Q3choice"])) {
        $q3Err = "please elect an answer for question three";
    } else {
        $q3Choice = test_input($_POST["Q3choice"]);
    }

    if (empty($_POST["Q4choice"])) {
        $q4Err = "please elect an answer for question four";
    } else {
        $q4Choice = test_input($_POST["Q4choice"]);
    }


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<h3>You are currently taking the <?php echo $_SESSION["quizName"] ; ?> Quiz</h3>

<?php
//select the quiz name from the quiz table
$quizName = $_SESSION["quizName"];
//select the first questions associated with the quiz name
//q1
$sql = "SELECT * FROM question where quiz_name = '$quizName'  AND qID = 1";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
    //set the question and correct answer from the database
    while($row = $result->fetch_assoc()) {
        $Q1Ans = $row["question_answer"];
        $Q1= "<h3>Question" . $row["qID"] .": "  . $row["question"]  .  "<br> </h3>";
    }
} else {
    echo "0 results";
}

///q2
$sql = "SELECT * FROM question where quiz_name = '$quizName'  AND qID = 2";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
// set the question and correct answer
    while($row = $result->fetch_assoc()) {
        $Q2Ans = $row["question_answer"];
        $Q2= "<h3>Question" . $row["qID"] .": "  . $row["question"]  .  "<br> </h3>";
    }
} else {
    echo "0 results";
}

//q3
$sql = "SELECT * FROM question where quiz_name = '$quizName'  AND qID = 3";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
// set the question and correct answer
    while($row = $result->fetch_assoc()) {
        $Q3Ans = $row["question_answer"];
        $Q3= "<h3> Question" . $row["qID"] .": "  . $row["question"]  .  "<br> </h3>";
    }
} else {
    echo "0 results";
}

//q4
$sql = "SELECT * FROM question where quiz_name = '$quizName'  AND qID = 4";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
// set the question and the correct answer
    while($row = $result->fetch_assoc()) {
        $Q4Ans = $row["question_answer"];
        $Q4= "<h3>Question" . $row["qID"] .": "  . $row["question"]  .  "<br> </h3>";
    }
} else {
    echo "0 results";
}

?>



<h3>Please answer the following questions</h3>
<p><span class="error">* required fields</span>
<h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">     <!-- form for taking user answers to the quiz-->
    <?php echo $Q1;?><br>
    Q1 Answer: <input type="text" name="Q1choice">
    <span class="error">* <?php echo $q1Err;?></span>                                   <!--error message if input blank or invalid -->
    <br><br>
    <?php echo $Q2;?><br>
    Q2 Answer: <input type="text" name="Q2choice">
    <span class="error">* <?php echo $q2Err;?></span>
    <br><br>
    <?php echo $Q3;?><br>
    Q3 Answer: <input type="text" name="Q3choice">
    <span class="error">* <?php echo $q3Err;?></span>
    <br><br>
    <?php echo $Q4;?><br>
    Q4 Answer: <input type="text" name="Q4choice">
    <span class="error">* <?php echo $q4Err;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit and review">
</form></h3>

<?php
$score = 0;                                     //set score variable to 0, used for counting users score
$q1Choice = strtoupper($q1Choice);
$q2Choice = strtoupper($q2Choice);
$q3Choice = strtoupper($q3Choice);
$q4Choice = strtoupper($q4Choice);

//if user presses submit and user answers match the correct answer, increment score counter
if(isset($_POST["submit"]))
{
   if($q1Choice == $Q1Ans)
   {
       $score = $score + 1;
   }

    if($q2Choice == $Q2Ans)
    {
        $score = $score + 1;
    }

    if($q3Choice == $Q3Ans)
    {
        $score = $score + 1;
    }

    if($q4Choice == $Q4Ans)
    {
        $score = $score + 1;
    }

    $_SESSION["score"] = $score;

    //update the score table
    $sql = "INSERT INTO score (email_address, quiz_name, score)
VALUES ('{$_SESSION["email"]}', '{$_SESSION["quizName"]}', '$score')";

    if ($conn->query($sql) === TRUE) {
        echo "Score has been saved";                                // inform the user the score has been saved
        header("Location: reviewQuiz.php");                   //take user the the quiz review page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



}
//close connection
$conn->close();


?>


</body>
</html>