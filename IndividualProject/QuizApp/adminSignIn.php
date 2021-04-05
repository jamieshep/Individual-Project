<?php
// Start the session
session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
    <link rel="stylesheet" href="sheet.css">
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a>
</head>
<body>

<?php
include 'connect.php';
// define variables and set to empty values
$emailErr = $passwordErr =  "";
$email = $password =  "";

//if fields are valid and not empty, set variables, otherwise set error messages
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {         //validating email address
            $emailErr = "Invalid email format";}
    }

    if (empty($_POST["password"])) {
        $passwordErr = "please enter a password";
    } else {
        $password = test_input($_POST["password"]);
    }


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Please Login as a Lecturer</h2>
<p><span class="error">* required field</span></p>
<h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">         <!-- form for taking email and password for sign in -->
    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr;?></span>                                   <!-- display error message previously set if error occurs -->
    <br><br>
    password: <input type="password" name="password">
    <span class="error"><?php echo $passwordErr;?></span>
    <br><br>
    <input type="submit" name="login" value="Submit">
</form></h3>

<?php

//if login button pressed
if(isset($_POST["login"]))
{
    $query = "SELECT * FROM `lecturer` WHERE email_address='$email'";       //query for checking if this email address matches with one in the database
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1 and $row = $result->fetch_assoc()){                         //if there is an email match
        if(password_verify($password, $row["password"]))                   //check if the password matches the one associated with this email address
        {
            $_SESSION['email'] = $email;                                   //set session variable
            header("Location: lecturer.php");                        // Redirect user to student.php
        }

    }else{
        // prompt user to register if they are not able to login
        echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/><h2>Click here to <a href='studentReg.php'>register</a></h2></div>";
    }
}

$conn->close();

echo "<br>";
echo "<br>";


?>

</body>
</html>