<?php
session_start();
require_once "../../connect/connectDb/config.php";

if (isset($_POST['uploadVideo'])) {

// GETTING POST TEXT DATA
$videoTitle = mysqli_escape_string($link, htmlentities($_POST['videoTitle']));
$videoDescription = mysqli_escape_string($link, htmlentities($_POST['videoDescription']));
$videoTags = mysqli_escape_string($link, htmlentities($_POST['videoTags']));
$videoCategory = $_POST['videoCategory'];
$videoLink = mysqli_escape_string($link, htmlentities($_POST['videoLink']));
$videoThumbnail = "";
 

//TIME AND DATE 
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d");
$time = date("H:i:s");

$dateTime = $date . " " . $time;

// GETTING THE VIDEO ID
$videoId = "";
$videoDummyLink1 = "https://youtu.be/";
$videoDummyLink2 = "https://www.youtube.com/watch?v=";

if (strpos($videoLink, $videoDummyLink1) !== false) {
     $videoId = str_replace($videoDummyLink1, '', $videoLink);
} else if (strpos($videoLink, $videoDummyLink2) !== false) {
     $videoId = str_replace($videoDummyLink2, '', $videoLink);
} else {
     $videoId = "Undefined";
}

// CHECKING THAT VIDEO IS NEW OR NOT

$checkingVideoIsNewQuery = "SELECT * FROM `78000_videos` WHERE `videoUniCode` = '$videoId'";
$fireCheckingVideoIsNewQuery = mysqli_query($link, $checkingVideoIsNewQuery);

if (mysqli_num_rows($fireCheckingVideoIsNewQuery) == 0) {

     // VIDEO UNI CODE
     $videoUniCode = md5($videoId);

     // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
     $temp = explode(".", $_FILES["thumbnailFile"]["name"]);
     $file_name = md5($videoId) . "." . end($temp);

     // GETTING THE THUMBNAIL FILE DATA
     $file_type = $_FILES["thumbnailFile"]["type"];
     $temp_name = $_FILES["thumbnailFile"]["tmp_name"];
     $file_size = $_FILES["thumbnailFile"]["size"];
     $error = $_FILES["thumbnailFile"]["error"];

     // THIS FUNCTION COMPRESS THE THUMBNAIL FILE
     function compress_image($source_url, $destination_url, $quality)
     {
          $info = getimagesize($source_url);
          if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
          elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
          elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
          imagejpeg($image, $destination_url, $quality);
          return "Image uploaded successfully.";
     }

     // IF THE TOTAL IMAGE ERROR IS ZERO THEN FINALLY HERE WE COMPRESS THE FILE AND SAVE IT 
     if ($error > 0) {
          echo $error;
     } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
          $filename = compress_image($temp_name, "../../data/user/videothumbnail/" . $file_name, 30);
          if ($filename = "Image uploaded successfully.") {
               $videoThumbnail = $file_name;
          }
     } else {
          echo "Uploaded image should be jpg, jpeg or png.";
     }

     // GETTING CHANNEL DETAILS
     $channelId = mysqli_escape_string($link, htmlentities($_POST['channel']));
     $channelUniCode = mysqli_escape_string($link, htmlentities($_POST['channelUniCode']));
     $channelName = mysqli_escape_string($link, htmlentities($_POST['channelName']));
     $channelLogo = mysqli_escape_string($link, htmlentities($_POST['logoLink']));
     $channelDesc = mysqli_escape_string($link, htmlentities($_POST['channelDesc']));


     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];



     // SAVING IN DATABASE

     $saveInDatabaseQuery = "INSERT INTO `78000_videos`(`videoTitle`, `videoDescription`, `videoTags`, `videoLink`, `videoUniCode`, `videoThumbnail`, `videoCategory`, `channelId`, `channelUniCode`, `channelName`, `channelLogo`, `channelDesc`,`addedBy`,`addedByName`, `uploadTime`) VALUES ('$videoTitle','$videoDescription','$videoTags','$videoLink','$videoId','$videoThumbnail','$videoCategory','$channelId','$channelUniCode','$channelName','$channelLogo','$channelDesc','$adminId','$adminName','$dateTime')";
     $fireSaveInDatabaseQuery = mysqli_query($link, $saveInDatabaseQuery);

     if ($fireSaveInDatabaseQuery) {
          header('location: ../Channels');
     } else {
          header('location: ../');
     }
} else {
     $_SESSION['videoAlreadyExist'] = "Video Already Exist!";
     header('location: ../');
}
}