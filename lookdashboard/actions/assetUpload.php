<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Asset'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $description = mysqli_real_escape_string($link, $_POST['Description']);
     $download_link = mysqli_real_escape_string($link, $_POST['Download_link']);
     $tags = mysqli_real_escape_string($link, $_POST['Tags']);

     $userId = $_SESSION['userDetails'][0];
     $userName = $_SESSION['userDetails'][1];

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_assets`(`assetName`, `assetDescription`, `assetFile`, `assetThumbnail`, `assetTags`, `uploadedBy`, `uploaderId`, `uploaderName`,`assetStatus`) VALUES ('$name', '$description', '$download_link', '', '$tags','User','$userId','$userName','Admin') ";


     //firing the query 

     $fireq = mysqli_query($link, $q);

     if($fireq){
          $_SESSION['notifyWorkDone'] = "Uploaded Successfully! It will be available for all user after admin approval.";
     }

     header('location: ../');
}
