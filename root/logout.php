<?php
include 'sec_functions.php';
sec_session_start();
// Register logout in session table

// Unset all session values
$_SESSION = array();
// get session parameters 
$params = session_get_cookie_params();
// Delete the actual cookie.
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// Destroy session
session_destroy();
header('Location: /login.html');
