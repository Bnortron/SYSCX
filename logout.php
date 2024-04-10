<?php
// start session
session_start();

// Unset session variables
$_SESSION = array();

// Destroy session
session_destroy();

// redirect user to login
header("Location: login.php");
?>