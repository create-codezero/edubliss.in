<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Question'])) {

     //this is for simple text
     $answer = mysqli_real_escape_string($link, $_POST['answer']);
     $questionId = mysqli_real_escape_string($link, $_POST['questionId']);
     $haveAnsSS = mysqli_real_escape_string($link, $_POST['haveAnsSS']);


     //this is for the question Screenshot upload

     $answerSsName = $_FILES['answerss']['name'];
     $answerSsTempName = $_FILES['answerss']['tmp_name'];

     $temp = explode(".", $_FILES["answerss"]["name"]);
     $file_name = md5($questionId) . "." . end($temp);




     $answerFolder = "../../data/questions/ans/" . $file_name;

     // Uploading the Question SS
     move_uploaded_file($answerSsTempName, $answerFolder);

     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " UPDATE `78000_questions` SET `questionAnsSS`='$file_name',`questionAnsText`='$answer',`haveAnsSS` = '$haveAnsSS' WHERE `questionId` = '$questionId' ";

     //firing the query 

     mysqli_query($link, $q);


    // WORKDONE

    header('location: ../');
}
