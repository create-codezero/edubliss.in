<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Question'])) {

     //this is for simple text
     $question = mysqli_real_escape_string($link, $_POST['question']);
     $questionTag = mysqli_real_escape_string($link, $_POST['questionTag']);
     $topics = mysqli_real_escape_string($link, $_POST['topics']);

     $userId = $_SESSION['userDetails'][0];
     $userName = $_SESSION['userDetails'][1];


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

     $q = " INSERT INTO `78000_questions`(`questionSS`, `questionText`, `questionAnsSS`, `questionAnsText`, `questionTags`, `variationOf`, `isMain`, `assignment`, `assignmentName`, `totalVariation`, `questionOf`, `subject`, `subjectName`, `customValues`, `getCustomAns`, `solverAlgo`, `askedBy`,`askerId`,`askerName`, `questionStatus`, `questionTime`) VALUES ('$file_name','$question','','','$questionTag','none','1','','$assignmentName','0','$topics','','$subjectName','null','0','null','User','$userId','$userName','Admin','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);


    // WORKDONE

    header('location: ../');
}
