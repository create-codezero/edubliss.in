<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Subject'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $topics = mysqli_real_escape_string($link, $_POST['Topics']);
     $assignment = mysqli_real_escape_string($link, $_POST['Assignment']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];


     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_a_subjects`(`aSubject`, `aSubjectWeek`, `totalQuestions`, `aSubjectTopics`,`addedBy`,`addedByName`, `aSubjectStatus`, `time`) VALUES ('$name','$assignment','0','$topics','$adminId','$adminName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);


    //  UPDATING THE TOTAL NUMBER OF SUBJECTS IN ASSIGNMENT TABLE

     $q2 = "SELECT `totalSubject` from `78000_a_week` WHERE `aWeekId` = '$assignment'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalSubject'];
        }
     }

     $newq2val = intval($q2value) + 1;

     $q3 = "UPDATE `78000_a_week` SET `totalSubject`='$newq2val' WHERE `aWeekId` = '$assignment'";
     $fireq3 = mysqli_query($link, $q3);

     header('location: ../');
}
