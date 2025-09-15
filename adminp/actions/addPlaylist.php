<?php
session_start();
require_once "../../connect/connectDb/config.php";

if (isset($_POST['uploadPlaylist'])) {

// GETTING POST TEXT DATA
$playlistTitle = mysqli_escape_string($link, htmlentities($_POST['playlistTitle']));
$playlistDescription = mysqli_escape_string($link, htmlentities($_POST['playlistDescription']));
$playlistTags = mysqli_escape_string($link, htmlentities($_POST['playlistTags']));
$playlistLink = mysqli_escape_string($link, htmlentities($_POST['playlistLink']));
$playlistThumbnail = "";


//TIME AND DATE 
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d");
$time = date("H:i:s");

$dateTime = $date . " " . $time;

// GETTING THE VIDEO ID
$playlistId = "";
$playlistDummyLink1 = "https://www.youtube.com/playlist?list=";

if (strpos($playlistLink, $playlistDummyLink1) !== false) {
     $playlistId = str_replace($playlistDummyLink1, '', $playlistLink);
}else{
    $playlistId = $playlistLink;
}

// CHECKING THAT VIDEO IS NEW OR NOT

$checkingPlaylistIsNewQuery = "SELECT * FROM `78000_playlists` WHERE playlistLink = '$playlistId'";
$fireCheckingPlaylistIsNewQuery = mysqli_query($link, $checkingPlaylistIsNewQuery);

if (mysqli_num_rows($fireCheckingPlaylistIsNewQuery) == 0) {

     // VIDEO UNI CODE
     $playlistUniCode = md5($playlistId);

     // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
     $temp = explode(".", $_FILES["thumbnailFile"]["name"]);
     $file_name = md5($playlistId) . "." . end($temp);

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
          $filename = compress_image($temp_name, "../../data/watch/playlistthumbnail/" . $file_name, 20);
          if ($filename = "Image uploaded successfully.") {
               $playlistThumbnail = $file_name;
          }
     } else {
          echo "Uploaded image should be jpg, jpeg or png.";
     }

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];

     // SAVING IN DATABASE

     $saveInDatabaseQuery = "INSERT INTO `78000_playlists`(`playlistName`, `playlistDescription`, `playlistLink`, `playlistThumbnail`, `playlistTags`, `playlistStatus`, `addedBy`, `addedByName`, `addedOn`) VALUES ('$playlistTitle','$playlistDescription','$playlistLink','$file_name','$playlistTags','Public','$adminId','$adminName','$dateTime')";
     $fireSaveInDatabaseQuery = mysqli_query($link, $saveInDatabaseQuery);

     if ($fireSaveInDatabaseQuery) {
          header('location: ../Playlists');
     } else {
          header('location: ../');
     }
} else {
     $_SESSION['playlistAlreadyExist'] = "Playlist Already Exist!";
     header('location: ../');
}
}