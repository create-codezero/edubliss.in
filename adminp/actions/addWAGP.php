<?php
session_start();
require_once "../../connect/connectDb/config.php";


if (isset($_POST['Add_WAGP'])) {

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];

     $wagpName = mysqli_real_escape_string($link, $_POST['wagpName']);
     $wagpLink = mysqli_real_escape_string($link, $_POST['wagpLink']);
     $logoLink = "";

     // FETCHING THE CHANNEL UNIQUE ID
     $dummyChannelLink1 = "https://chat.whatsapp.com/";
     if (strpos($wagpLink, $dummyChannelLink1) !== false) {

          $wagpLink = str_replace($dummyChannelLink1, '', $wagpLink);
     } else {

          $wagpLink = "Undefined";
     }

     $wagpUniCode = md5($wagpLink);

     if (!empty($_FILES['newGroupLogo']['name']) || $_FILES['newGroupLogo']['size'] != 0) {
          // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
          $temp = explode(".", $_FILES["newGroupLogo"]["name"]);
          $file_name = md5($wagpLink) . "." . end($temp);

          // GETTING THE THUMBNAIL FILE DATA
          $file_type = $_FILES["newGroupLogo"]["type"];
          $temp_name = $_FILES["newGroupLogo"]["tmp_name"];
          $file_size = $_FILES["newGroupLogo"]["size"];
          $error = $_FILES["newGroupLogo"]["error"];

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
               $filename = compress_image($temp_name, "../../data/wagp/logo/" . $file_name, 30);
               if ($filename = "Image uploaded successfully.") {
                    $logoLink = $file_name;
               }
          } else {
               header('location: ../');
          }
     }else{
          header('location: ../');
     }

      

    //TIME AND DATE 
    date_default_timezone_set('Asia/Calcutta');
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $dateTime = $date . " " . $time;


     $wagpDesc = mysqli_real_escape_string($link, $_POST['wagpDesc']);

     $check_campaign_query = " SELECT * FROM `78000_wagroups` WHERE wagpLink = '$wagpLink' ";
     $check_campaign_fire = mysqli_query($link, $check_campaign_query);
     $check_campaign_count = mysqli_num_rows($check_campaign_fire);


     if ($check_campaign_count == 0) {
          // NEW wagp

          $check_campaign_query = " SELECT * FROM `78000_wagroups` WHERE wagpLink = '$wagpLink' ";
          $check_campaign_fire = mysqli_query($link, $check_campaign_query);
          $check_campaign_count = mysqli_num_rows($check_campaign_fire);

          if ($check_campaign_count == 0) {
               $insertquery = "INSERT INTO `78000_wagroups`(`wagpName`, `wagpDescription`, `wagpLink`, `wagpLogo`, `wagpStatus`, `addedBy`, `addedByName`, `addedTime`) VALUES ('$wagpName','$wagpDesc','$wagpLink','$file_name','Public','$adminId','$adminName','$dateTime')";
               $insertquery_fire = mysqli_query($link, $insertquery);

          } else {
               $_SESSION['wagpAlreadyCreated'] = "This wagp is already created by another user.";
               header("location: ../");
          }

     } else {
          // UPDATE wagp

          $insertquery = "UPDATE `78000_wagroups` SET `wagpName`='$wagpName',`wagpDescription`='$wagpDesc',`wagpLink`='$wagpLink',`wagpLogo`='$file_name' WHERE `wagpLink` = '$wagpLink'";
          $insertquery_fire = mysqli_query($link, $insertquery);

     }
}


header("location: ../");
