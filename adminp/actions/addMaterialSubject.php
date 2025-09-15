<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Subject'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $course = mysqli_real_escape_string($link, $_POST['Course']);
     $level = mysqli_real_escape_string($link, $_POST['Level']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];


     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_subjects`(`subjectName`, `totalMaterials`, `subjectLevel`, `subjectCourse`, `addedBy`, `addedByName`, `subjectStatus`, `createdOn`) VALUES ('$name','0','$level','$course','$adminId','$adminName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);

     //  UPDATING THE TOTAL NUMBER OF SUBJECTS IN COURSE TABLE

     $q2 = "SELECT `totalSubjects` from `78000_courses` WHERE `courseId` = '$course'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalSubjects'];
        }
     }

     $newq2val = intval($q2value) + 1;

     $q3 = "UPDATE `78000_courses` SET `totalSubjects`='$newq2val' WHERE `courseId` = '$course'";
     $fireq3 = mysqli_query($link, $q3);


     //  UPDATING THE TOTAL NUMBER OF SUBJECTS IN LEVEL TABLE

     $q4 = "SELECT `totalSubjects` from `78000_levels` WHERE `levelId` = '$level'";
     $q4val = mysqli_query($link, $q4);

     if(mysqli_num_rows($q4val) > 0){
        while($q4vall = mysqli_fetch_assoc($q4val)){
            $q4value = $q4vall['totalSubjects'];
        }
     }

     $newq4val = intval($q4value) + 1;

     $q5 = "UPDATE `78000_levels` SET `totalSubjects`='$newq4val' WHERE `levelId` = '$level'";
     $fireq5 = mysqli_query($link, $q5);


     header('location: ../');
}
