<?php
session_start();
require_once "../../connect/connectDb/config.php";


if (isset($_POST['channel_submit'])) {

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];

     $channelName = mysqli_real_escape_string($link, $_POST['channelName']);
     $channelLink = mysqli_real_escape_string($link, $_POST['channelLink']);
     $logoLink = "";

     // FETCHING THE CHANNEL UNIQUE ID
     $dummyChannelLink1 = "https://www.youtube.com/c/";
     $dummyChannelLink2 = "https://www.youtube.com/";
     if (strpos($channelLink, $dummyChannelLink1) !== false) {

          $channelLink = str_replace($dummyChannelLink1, '', $channelLink);
     } else if (strpos($channelLink, $dummyChannelLink2) !== false) {

          $channelLink = str_replace($dummyChannelLink2, '', $channelLink);
     } else {

          $channelLink = "Undefined";
     }

     $channelUniCode = md5($channelLink);

     if (!empty($_FILES['newChannelLogo']['name']) || $_FILES['newChannelLogo']['size'] != 0) {
          // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
          $temp = explode(".", $_FILES["newChannelLogo"]["name"]);
          $file_name = md5($channelLink) . "." . end($temp);

          // GETTING THE THUMBNAIL FILE DATA
          $file_type = $_FILES["newChannelLogo"]["type"];
          $temp_name = $_FILES["newChannelLogo"]["tmp_name"];
          $file_size = $_FILES["newChannelLogo"]["size"];
          $error = $_FILES["newChannelLogo"]["error"];

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
               header('location: ../');
          } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
               $filename = compress_image($temp_name, "../../data/user/channellogo/" . $file_name, 20);
               if ($filename = "Image uploaded successfully.") {
                    $logoLink = $file_name;
               }
          } else {
               header('location: ../');
          }
     } else if (!empty($_POST['logoLink'])) {
          $logoLink = mysqli_real_escape_string($link, $_POST['logoLink']);
     } else {
          header('location: ../');
     }


     $channelDesc = mysqli_real_escape_string($link, $_POST['channelDesc']);
     $category = mysqli_real_escape_string($link, $_POST['category']);
     $totalSubs = mysqli_real_escape_string($link, $_POST['totalSubs']);

     $check_campaign_query = " SELECT * FROM `78000_channels` WHERE channelLink = '$channelLink' ";
     $check_campaign_fire = mysqli_query($link, $check_campaign_query);
     $check_campaign_count = mysqli_num_rows($check_campaign_fire);


     if ($check_campaign_count == 0) {
          // NEW channel

          $check_campaign_query = " SELECT * FROM `78000_channels` WHERE channelLink = '$channelLink' ";
          $check_campaign_fire = mysqli_query($link, $check_campaign_query);
          $check_campaign_count = mysqli_num_rows($check_campaign_fire);

          if ($check_campaign_count == 0) {
               $insertquery = "INSERT INTO `78000_channels`(`channelName`, `channelLink`, `channelUniCode`, `logoLink`, `channelDesc`, `channelCat`, `channelSubs`,`addedBy`,`addedByName`) VALUES ('$channelName','$channelLink','$channelUniCode','$logoLink','$channelDesc','$category','$totalSubs','$adminId','$adminName')";
               $insertquery_fire = mysqli_query($link, $insertquery);

          } else {
               $_SESSION['channelAlreadyCreated'] = "This channel is already created by another user.";
               header("location: ../");
          }

     } else {
          // UPDATE channel

          $insertquery = "UPDATE `78000_channels` SET `channelName`= '$channelName',`logoLink`= '$logoLink',`channelDesc`= '$channelDesc',`channelCat`= '$category',`channelSubs`= '$totalSubs' WHERE `channelLink` = '$channelLink'";
          $insertquery_fire = mysqli_query($link, $insertquery);

     }
}


header("location: ../");
