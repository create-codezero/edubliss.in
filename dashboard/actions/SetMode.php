<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (!isset($_SESSION['userFullName'])) {
     header('location: ../');
}

$mode = $_POST['Mode'];
$userId = $_POST['userId'];
$modeasked = '1';

$query = "UPDATE `78000_user` SET `mode`='$mode', `mode_asked`='$modeasked' WHERE userId = '$userId'";
$results = mysqli_query($link, $query);

$query1 = "SELECT `mode` FROM `78000_user` WHERE userId = '$userId'";
$results1 = mysqli_query($link, $query1);

if (mysqli_num_rows($results1) == 1) {
     while ($a = mysqli_fetch_assoc($results1)) {
          $_SESSION['userDetails'][7] = $a['mode'];
          $_SESSION['userDetails'][8] = '1';
     }
}

echo $_SESSION['userDetails'][7];
