<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// unset cookies
$past = time() - (86400 * 30);
foreach ($_COOKIE as $key => $value) {
     setcookie($key, $value, $past, '/');
}

// Redirect to login page
header("location: ../../../");
