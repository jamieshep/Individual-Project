<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="sheet.css">
    <meta charset="UTF-8">
    <title>QuizApp</title>
    <a href="index.php">
        <img border="0" alt="logo" src="QuizAppLogo.PNG" width="500" height="150">
    </a><h1>Welcome to QuizApp!</h1>

</head>
<body>

<!-- Home page with buttons for registering and signing in -->

<br>
<br>
<div> <p> you can sign as a Lecturer to set a quiz </p></div>
<button onclick="document.location='adminSignIn.php'">Sign In as a Lecturer</button>
<button onclick="document.location='adminReg.php'">Register as a Lecturer</button><br><br>
<div><p>Or you can sign in as a student to take a quiz</p> </div>
<button onclick="document.location='studentSignIn.php'">Sign In as a Student</button>
<button onclick="document.location='studentReg.php'">Register a Student</button><br><br>



</body>
</html>