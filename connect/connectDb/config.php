<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'iitmbsds');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
if ($link === false) {
     die("ERROR: Could not connect. " . mysqli_connect_error());
}

// VARIABLES FOR STYLES AND JS
$cssfile = "style3.7.css";
$jsfile = "js1.9.js";
