<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Level'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $course = mysqli_real_escape_string($link, $_POST['Course']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];


     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_levels`(`levelName`, `totalSubjects`, `totalMaterials`, `levelCourse`, `addedBy`, `addedByName`, `levelStatus`, `createdOn`) VALUES ('$name','0','0','$course','$adminId','$adminName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);

     //  UPDATING THE TOTAL NUMBER OF LEVELS IN COURSE TABLE

     $q2 = "SELECT `totalLevels` from `78000_courses` WHERE `courseId` = '$course'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalLevels'];
        }
     }

     $newq2val = intval($q2value) + 1;

     $q3 = "UPDATE `78000_courses` SET `totalLevels`='$newq2val' WHERE `courseId` = '$course'";
     $fireq3 = mysqli_query($link, $q3);

     header('location: ../');
}
