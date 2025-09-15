<?php
session_start();
require_once "../connect/connectDb/config.php";
$errors = array();

// REGISTER USER
if (isset($_POST['bugTitle'])) {
     // receive all input values from the form
     $bugTitle = mysqli_real_escape_string($link, $_POST['bugTitle']);
     $bugDescription = mysqli_real_escape_string($link, $_POST['bugDescription']);
     $bugPage = mysqli_real_escape_string($link, $_POST['bugPage']);
     $reporterInstagram = mysqli_real_escape_string($link, $_POST['reporterInstagram']);
     $userFullName = $_SESSION['userDetails'][1];
     $userId = $_SESSION['userDetails'][0];

     $query = "INSERT INTO `78000_bugs`(`bugTitle`, `bugDescription`, `bugPage`, `bugReporterInstagram`, `bugReporterFullName`, `bugReporterUserId`) VALUES ('$bugTitle','$bugDescription','$bugPage','$reporterInstagram','$userFullName','$userId')";

     mysqli_query($link, $query);

     echo "Thanks for Reporting Bug.";
} else {
     header('location: ./');
}
