<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Assignment'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $topics = mysqli_real_escape_string($link, $_POST['Topics']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];


     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_a_week`(`aWeek`, `totalQuestions`, `totalSubject`, `aWeekTopics`,`addedBy`,`addedByName`, `aWeekStatus`, `time`) VALUES ('$name','0','0','$topics','$adminId','$adminName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);

     header('location: ../');
}
