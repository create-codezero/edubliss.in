<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (!isset($_SESSION['userFullName'])) {
     header('location: ../');
}
if (isset($_POST['User_ques'])) {
     $user_ques = mysqli_escape_string($link, htmlentities($_POST['User_ques']));
     $userId = $_POST['userId'];
     $userFullName = $_SESSION['userDetails'][1];
     $userUniqueCode = $_SESSION['userDetails'][5];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $query = "INSERT INTO `78000_user_queries`(`userId`, `userUniqueCode`, `userFullName`, `userQues`, `queryTime`) VALUES ('$userId','$userUniqueCode','$userFullName','$user_ques','$dateTime')";
     mysqli_query($link, $query);
} else {
     header('location: ../');
}
