<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Question'])) {

     //this is for simple text
     $question = mysqli_real_escape_string($link, $_POST['question']);
     $questionTag = mysqli_real_escape_string($link, $_POST['questionTag']);
     $topics = mysqli_real_escape_string($link, $_POST['topics']);
     $assignment = mysqli_real_escape_string($link, $_POST['assignment']);
     $subject = mysqli_real_escape_string($link, $_POST['subject']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];


     //  GETTING ASSIGNMENT NAME AND SUBJECT NAME
     $assignmentName = mysqli_real_escape_string($link, $_POST['assignmentName']);
     $subjectName = mysqli_real_escape_string($link, $_POST['subjectName']);


     //this is for the question Screenshot upload

     $questionSsName = $_FILES['questionss']['name'];
     $questionSsTempName = $_FILES['questionss']['tmp_name'];

     //  giving unique new name to question ss
     $qAllQuestion = "SELECT * FROM `78000_questions`";
     $fireQAllQuestioin = mysqli_query($link, $qAllQuestion);

     $TotalQuestion = mysqli_num_rows($fireQAllQuestioin);

     $newQuestioinId = intval($TotalQuestion) + 1;

     $temp = explode(".", $_FILES["questionss"]["name"]);
     $file_name = md5($newQuestioinId) . "." . end($temp);




     $questionFolder = "../../data/questions/ques/" . $file_name;

     // Uploading the Question SS
     move_uploaded_file($questionSsTempName, $questionFolder);

     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_questions`(`questionSS`, `questionText`, `questionAnsSS`, `questionAnsText`, `questionTags`, `variationOf`, `isMain`, `assignment`, `assignmentName`, `totalVariation`, `questionOf`, `subject`, `subjectName`, `customValues`, `getCustomAns`, `solverAlgo`, `askedBy`,`askerId`,`askerName`, `questionStatus`, `questionTime`) VALUES ('$file_name','$question','','','$questionTag','none','1','$assignment','$assignmentName','0','$topics','$subject','$subjectName','null','0','null','Admin','$adminId','$adminName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);


    //  UPDATE NUMBER OF QUESTIONS IN SUBJECT AND ASSIGNMENT TABLE

    //FIRST ASSIGNMENT TABLE

    $q2 = "SELECT `totalQuestions` from `78000_a_week` WHERE `aWeekId` = '$assignment'";
    $q2val = mysqli_query($link, $q2);

    if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalQuestions'];
        }
    }

    $newq2val = intval($q2value) + 1;

    $q3 = "UPDATE `78000_a_week` SET `totalQuestions`='$newq2val' WHERE `aWeekId` = '$assignment'";
    $fireq3 = mysqli_query($link, $q3);


    // NOW SUBJECT TABLE

    $q3 = "SELECT `totalQuestions` from `78000_a_subjects` WHERE `aSubjectId` = '$subject'";
    $q3val = mysqli_query($link, $q3);

    if(mysqli_num_rows($q3val) > 0){
        while($q3vall = mysqli_fetch_assoc($q3val)){
            $q3value = $q3vall['totalQuestions'];
        }
    }

    $newq3val = intval($q3value) + 1;

    $q3 = "UPDATE `78000_a_subjects` SET `totalQuestions`='$newq3val' WHERE `aSubjectId` = '$subject'";
    $fireq3 = mysqli_query($link, $q3);


    // WORKDONE

    header('location: ../');
}
