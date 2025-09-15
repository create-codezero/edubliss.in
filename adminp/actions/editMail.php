<?php
session_start();
require_once "../../connect/connectDb/config.php";
$errors = array();
if (isset($_POST['updateMail']) && isset($_POST['mailContent'])) {
     //this is for simple text upload

     $emailId = $_POST['emailId'];
     $mailContent = $_POST['mailContent'];

     $mailContent = str_replace("'", `'. "'" .'`, $mailContent);

     $mailName = $_POST['mailName'];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;



     //from here the inserting php is starts

     $q = " UPDATE `78000_emails` SET `emailName`='$mailName',`emailContent`='$mailContent',`addedOn`='$dateTime' WHERE `emailId` = '$emailId' ";


     //firing the query 

     mysqli_query($link, $q);

     echo 1;
}
