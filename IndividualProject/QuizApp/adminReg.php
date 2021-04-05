<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
    <link rel="stylesheet" href="sheet.css">
    <title>Register</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a>
</head>
<body>

<?php
include 'connect.php';
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $passwordErr =  "";
$fname = $lname = $email = $password =  "";
$regErr = 0;

//setting the values if they have been entered otherwise setting an error message and incrementing error counter
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
        $fnameErr = "first Name is required";
        $regErr = $regErr +1;
    } else {
        $fname = test_input($_POST["fname"]);
    }

    if (empty($_POST["lname"])) {
        $lnameErr = "last Name is required";
        $regErr = $regErr +1;
    } else {
        $lname = test_input($_POST["lname"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $regErr = $regErr +1;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";}
    }

    if (empty($_POST["password"])) {
        $passwordErr = "please enter a password";
        $regErr = $regErr +1;
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

<h2>Please register for a lecturer account below</h2>
<p><span class="error">* required field</span></p>
<h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">         <!-- form for taking user details-->
    First Name: <input type="text" name="fname">
    <span class="error">* <?php echo $fnameErr;  ?></span>
    <br><br>
    Last Name: <input type="text" name="lname">
    <span class="error">* <?php echo $lnameErr;  ?></span>
    <br><br>
    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr;  ?></span>
    <br><br>
    password: <input type="password" name="password">
    <span class="error"><?php echo $passwordErr;  ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form></h3>
<p>After registering please login with your details</p>
<button onclick="document.location='adminSignIn.php'">Sign In</button><br><br>


<?php

//hashing password user enters
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//if user has entered values for all fields and error counter == 0
if(isset($_POST["submit"]) AND $regErr == 0)
{
$sql = "SELECT * FROM lecturer  WHERE email_address = '$email'";    // check if lecturer already exists with the entered email address
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
    echo "*Please make sure you registering with a valid email address*";
} else {
    //if no other errors have occurred, insert the entered details into the lecturer table of the database
    $sql = "INSERT INTO lecturer (email_address, password, first_name, last_name)    
                 VALUES ('$email', '$hashed_password', '$fname', '$lname')";

    if ($conn->query($sql) === TRUE) {
        echo "Registered successfully ";                //inform the user they have been registered successfully
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}

//close connection to the database
$conn->close();

?>

</body>
</html>