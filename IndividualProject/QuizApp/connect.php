<?php
/**
 *
 */

$servername = "devweb2020.cis.strath.ac.uk";
$username = "fqb17202";
$password = "eerao2Jiu3do";
$dbname = "fqb17202";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

?>