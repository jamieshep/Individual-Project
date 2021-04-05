<?php
// Start the session
session_start();
include 'connect.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
    <link rel="stylesheet" href="sheet.css">
    <title>Create Quiz</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a>
    <br>
    <h1>logged in as Lecturer: <?php echo $_SESSION["email"] . "<br><br>"; ?></h1>
    <br>
    <button onclick="document.location='lecturer.php'">Return to lecturer options</button><br><br>
    <p>please enter questions and possible answers in the question box and the correct answer in the answer box</p>
</head>
<body>

<?php
// define variables and set to empty values

$quizNameErr = $QErr = $QAnsErr = "";
$quizName = $Q1 = $Q1Ans = $Q2 = $Q2Ans = $Q3 = $Q3Ans = $Q4 = $Q4Ans ="";
$submitErr = 0;


//setting the values if they have been entered otherwise setting an error message and incrementing error counter
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["quizName"])) {
        $quizNameErr = "Quiz Name is required";
        $submitErr = $submitErr +1;
    } else {
        $quizName = test_input($_POST["quizName"]);
    }

    if (empty($_POST["q1"])) {
        $QErr = "Please enter quiz question and label possible answers";
        $submitErr = $submitErr +1;
    } else {
        $Q1 = test_input($_POST["q1"]);
    }

    if (empty($_POST["q1ans"])) {
        $QAnsErr = "please enter a correct answer from A, B, C or D";
        $submitErr = $submitErr +1;
    } else {
        $Q1Ans = test_input($_POST["q1ans"]);
    }

    if (empty($_POST["q2"])) {
        $QErr = "Please enter quiz question and label possible answers";
        $submitErr = $submitErr +1;
    } else {
        $Q2 = test_input($_POST["q2"]);
    }

    if (empty($_POST["q2ans"])) {
        $QAnsErr = "please enter a correct answer from the choices";
        $submitErr = $submitErr +1;
    } else {
        $Q2Ans = test_input($_POST["q2ans"]);
    }

    if (empty($_POST["q3"])) {
        $QErr = "Please enter quiz question and label possible answers";
        $submitErr = $submitErr +1;
    } else {
        $Q3 = test_input($_POST["q3"]);
    }

    if (empty($_POST["q3ans"])) {
        $QAnsErr = "please enter a correct answer from the choices";
        $submitErr = $submitErr +1;
    } else {
        $Q3Ans = test_input($_POST["q3ans"]);
    }

    if (empty($_POST["q4"])) {
        $QErr = "Please enter quiz question and label possible answers";
        $submitErr = $submitErr +1;
    } else {
        $Q4 = test_input($_POST["q4"]);
    }

    if (empty($_POST["q4ans"])) {
        $QAnsErr = "please enter a correct answer from the choices";
        $submitErr = $submitErr +1;
    } else {
        $Q4Ans = test_input($_POST["q4ans"]);
    }


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Please fill out question details</h2>
<p><span class="error">* required field</span></p>
<h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Quiz Name: <input type="text" name="quizName">
    <span class="error">* <?php echo $quizNameErr;?></span>
    <br><br>
    Question 1: <textarea name="q1" rows="5" cols="40"></textarea>
    <span class="error">* <?php echo $QErr;?></span>
    <br><br>
    Please type the correct answer to the question:
    <br><br>
    Q1 answer: <input type = "text" name="q1ans" ></input>
    <span class="error">* <?php echo $QAnsErr;?></span>
    <br><br>
    Question 2: <textarea name="q2" rows="5" cols="40"></textarea>
    <span class="error">* <?php echo $QErr;?></span>
    <br><br>
    Please type the correct answer to the question:
    <br><br>
    Q2 answer: <input type = "text" name="q2ans" ></input>
    <span class="error">* <?php echo $QAnsErr;?></span>
    <br><br>
    Question 3: <textarea name="q3" rows="5" cols="40"></textarea>
    <span class="error">* <?php echo $QErr;?></span>
    <br><br>
    Please type the correct answer to the question:
    <br><br>
    Q3 answer: <input type = "text" name="q3ans" ></input>
    <span class="error">* <?php echo $QAnsErr;?></span>
    <br><br>
    Question 4: <textarea name="q4" rows="5" cols="40"></textarea>
    <span class="error">* <?php echo $QErr;?></span>
    <br><br>
    Please type the correct answer to the question:
    <br><br>
    Q4 answer: <input type = "text" name="q4ans" ></input>
    <span class="error">* <?php echo $QAnsErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form></h3>


<?php

$Q1Ans = strtoupper($Q1Ans);
$Q12Ans = strtoupper($Q2Ans);
$Q3Ans = strtoupper($Q3Ans);
$Q4Ans = strtoupper($Q4Ans);

if(isset($_POST["submit"]) AND $submitErr == 0)
{
    $sql = "SELECT * FROM quiz  WHERE quiz_name = '$quizName'";
    $result = $conn -> query($sql);

    if ($result->num_rows > 0) {
        echo "Quiz with this name already in system";
    } else {
        $sql = "INSERT INTO quiz (quiz_name, email_address)
                 VALUES ('$quizName', '{$_SESSION["email"]}')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO question (quiz_name, qID, question, question_answer)
                 VALUES ('$quizName', 1, '$Q1', '$Q1Ans')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO question (quiz_name, qID, question, question_answer)
                 VALUES ('$quizName', 2, '$Q2', '$Q2Ans')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO question (quiz_name, qID, question, question_answer)
                 VALUES ('$quizName', 3, '$Q3', '$Q3Ans')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO question (quiz_name, qID, question, question_answer)
                 VALUES ('$quizName', 4, '$Q4', '$Q4Ans')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo"<p>quiz created successfully</p>";
    }
}


$conn->close();
?>



