<?php
session_start();
require_once "../../connect/connectDb/config.php";


if (isset($_POST['profile_submit'])) {
     $channelName = mysqli_real_escape_string($link, $_POST['channelName']);
     $channelLink = mysqli_real_escape_string($link, $_POST['channelLink']);
     $logoLink = "";


     // FETCHING THE CHANNEL UNIQUE ID
     $channelId = "";
     $dummyChannelLink1 = "https://www.youtube.com/c/";
     $dummyChannelLink2 = "https://www.youtube.com/";
     if (strpos($channelLink, $dummyChannelLink1) !== false) {

          $channelId = str_replace($dummyChannelLink1, '', $channelLink);
     } else if (strpos($channelLink, $dummyChannelLink2) !== false) {

          $channelId = str_replace($dummyChannelLink2, '', $channelLink);
     } else {

          $channelId = "Undefined";
     }

     $channelUniCode = md5($channelId);

     if (!empty($_FILES['newLogoLink']['name']) || $_FILES['newLogoLink']['size'] != 0) {
          // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
          $temp = explode(".", $_FILES["newLogoLink"]["name"]);
          $file_name = md5($channelId) . "." . end($temp);

          // GETTING THE THUMBNAIL FILE DATA
          $file_type = $_FILES["newLogoLink"]["type"];
          $temp_name = $_FILES["newLogoLink"]["tmp_name"];
          $file_size = $_FILES["newLogoLink"]["size"];
          $error = $_FILES["newLogoLink"]["error"];

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
               $filename = compress_image($temp_name, "../../data/user/collabchannellogo/" . $file_name, 20);
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
     $instagramId = mysqli_real_escape_string($link, $_POST['instagramId']);
     $emailId = mysqli_real_escape_string($link, $_POST['emailId']);
     $phoneNum = mysqli_real_escape_string($link, $_POST['phoneNum']);
     $collabUser = $_SESSION['userDetails'][5];

     $check_collab_query = " SELECT * FROM `78000_collab_profile` WHERE collabUser = '$collabUser' ";
     $check_collab_fire = mysqli_query($link, $check_collab_query);
     $check_collab_count = mysqli_num_rows($check_collab_fire);




     if ($check_collab_count == 0) {
          // NEW COLLAB
          $insertquery = "INSERT INTO `78000_collab_profile`(`channelName`, `channelLink`,`logoLink`, `channelDesc`, `channelCat`, `subscriberCount`, `InstagramId`, `emailId`, `phoneNum`, `collabUser`) VALUES ('$channelName','$channelLink','$logoLink','$channelDesc','$category','$totalSubs','$instagramId','$emailId','$phoneNum','$collabUser')";
          $insertquery_fire = mysqli_query($link, $insertquery);

          if ($insertquery) {
               $check_collab_query = " SELECT * FROM `78000_collab_profile` WHERE collabUser = '$collabUser' ";
               $check_collab_fire = mysqli_query($link, $check_collab_query);
               $check_collab_count = mysqli_num_rows($check_collab_fire);
               if ($check_collab_count == 1) {
                    $collabDetails = array($channelName, $channelLink, $logoLink, $channelDesc, $category, $totalSubs, $instagramId, $emailId, $phoneNum, $collabUser);
                    $_SESSION['collabDetails'] = $collabDetails;
                    header("location: ../");
               }
          } else {
               echo "Query not fired!";
          }
     } else {
          // UPDATE COLLAB

          $insertquery = "UPDATE `78000_collab_profile` SET `channelName`= '$channelName',`channelLink`= '$channelLink',`logoLink`= '$logoLink',`channelDesc`= '$channelDesc',`channelCat`= '$category',`subscriberCount`= '$totalSubs',`InstagramId`= '$instagramId',`emailId`= '$emailId',`phoneNum`= '$phoneNum' WHERE collabUser = '$collabUser'";
          $insertquery_fire = mysqli_query($link, $insertquery);

          if ($insertquery) {
               $check_collab_query = " SELECT * FROM `78000_collab_profile` WHERE collabUser = '$collabUser' ";
               $check_collab_fire = mysqli_query($link, $check_collab_query);
               $check_collab_count = mysqli_num_rows($check_collab_fire);
               if (
                    $check_collab_count == 1
               ) {
                    $collabDetails = array($channelName, $channelLink, $logoLink, $channelDesc, $category, $totalSubs, $instagramId, $emailId, $phoneNum, $collabUser);
                    $_SESSION['collabDetails'] = $collabDetails;
                    header("location: ../");
               }
          } else {
               echo "Query not fired!";
          }
     }
}


header("location: ../");
