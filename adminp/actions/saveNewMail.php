<?php
session_start();
require_once "../../connect/connectDb/config.php";
$errors = array();
if (isset($_POST['mailContent'])) {
     //this is for simple text upload

     $mailContent = $_POST['mailContent'];
     $mailName = $_POST['mailName'];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;



     //from here the inserting php is starts

     $q = " INSERT INTO `78000_emails`(`emailName`, `emailContent`, `addedOn`) VALUES ('$mailName', '$mailContent', '$dateTime') ";


     //firing the query 

     mysqli_query($link, $q);

     echo 1;
}
