<?php
//destroy session and return to home page
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit;
