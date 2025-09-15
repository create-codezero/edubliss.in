<?php
session_start();
require_once '../../connect/connectDb/config.php';


if (isset($_POST['postText'])) {
     $postText = mysqli_escape_string($link, htmlentities($_POST['postText']));
     $userUniqueCode = $_SESSION['userUniqueCode'];
     $userFullName = $_SESSION['userDetails'][1];
     $userId = $_SESSION['userDetails'][0];
     $likeCount = 0;

     $totalPosts = "SELECT postSrNo FROM `78000_posts`";
     $fireTotalPosts = mysqli_query($link, $totalPosts);
     $totalPosts = mysqli_num_rows($fireTotalPosts);
     $srNo = $totalPosts + 1;
     $userLogo = $_SESSION['userDetails'][9];
     $userStatus = $_SESSION['userDetails'][11];

     $totalLike = 0;

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $insertStage1 = "INSERT INTO `78000_posts`(`postSrNo`, `postText`, `postImage`, `postRating`, `postPoll`, `totalLike`, `userId`, `userUniqueCode`, `userFullName`, `userLogo`,`postByUserStatus`, `postTime`) VALUES ('$srNo','$postText','false','false','false','$totalLike','$userId','$userUniqueCode','$userFullName','$userLogo','$userStatus','$dateTime')";
     $fireInsertStage1 = mysqli_query($link, $insertStage1);

     if ($fireInsertStage1) {
          echo "Posted Successfully!";
     } else {
          echo "Not Posted!";
     }


     if (isset($_FILES['postPhoto'])) {

          if (!empty($_FILES['postPhoto']['name']) || $_FILES['postPhoto']['size'] != 0) {

               $postImage = "true";

               // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
               $temp = explode(".", $_FILES["postPhoto"]["name"]);
               $file_name = md5($srNo) . "." . end($temp);

               // GETTING THE THUMBNAIL FILE DATA
               $file_type = $_FILES["postPhoto"]["type"];
               $temp_name = $_FILES["postPhoto"]["tmp_name"];
               $file_size = $_FILES["postPhoto"]["size"];
               $error = $_FILES["postPhoto"]["error"];


               // THIS FUNCTION COMPRESS THE THUMBNAIL FILE
               function compress_image($source_url, $destination_url, $quality, $file_name)
               {
                    $info = getimagesize($source_url);
                    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
                    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
                    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

                    // Saving a original Copy
                    $originalFolder = "../../data/user/originalpostimage/" . $file_name;
                    move_uploaded_file($source_url, $originalFolder);

                    imagejpeg($image, $destination_url, $quality);
                    return "Image uploaded successfully.";
               }

               // IF THE TOTAL IMAGE ERROR IS ZERO THEN FINALLY HERE WE COMPRESS THE FILE AND SAVE IT 
               if ($error > 0) {
                    header('location: ./');
               } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {

                    $filename = compress_image($temp_name, "../../data/user/postimage/" . $file_name, 50, $file_name);
                    if ($filename = "Image uploaded successfully.") {
                         $imageName = $file_name;

                         $insertStage2 = "UPDATE `78000_posts` SET `postImage`='$postImage',`imageName`='$imageName' WHERE postSrNo = '$srNo'";
                         $fireInsertStage2 = mysqli_query($link, $insertStage2);
                    }
               }
          }
     }


     if (isset($_POST['rating']) && $_POST['rating'] == "set") {
          $postRating = "true";
          $ratingPoint = 0;
          $totalRating = 0;
          $totalRatingStars = 0;

          $insertStage3 = "UPDATE `78000_posts` SET `postRating`='$postRating',`ratingPoint`='$ratingPoint',`totalRatingStars`='$totalRatingStars',`totalRating`='$totalRating' WHERE postSrNo = '$srNo'";
          $fireInsertStage3 = mysqli_query($link, $insertStage3);
     }

     if (isset($_POST['polling'])) {

          $postPoll = "true";
          $pollCount = $_POST['polling'];
          $pollPercent = "";
          $pollText = "";

          $i = 1;
          while ($i <= $pollCount) {
               $pollInputName = "poll" . $i;
               if ($i < $pollCount) {
                    $pollText .= mysqli_escape_string($link, htmlentities($_POST[$pollInputName])) . "||||PS||||";
                    $pollPercent .= "0||PPS||";
               } else if ($i == $pollCount) {
                    $pollText .= mysqli_escape_string($link, htmlentities($_POST[$pollInputName]));
                    $pollPercent .= "0";
               }
               $i = $i + 1;
          }

          $totalPolls = 0;

          $insertStage4 = "UPDATE `78000_posts` SET `postPoll`='$postPoll',`pollCount`='$pollCount',`pollText`='$pollText',`pollPercent`='$pollPercent',`totalPolls`='$totalPolls', `pollVote`='$pollPercent' WHERE postSrNo = '$srNo'";
          $fireInsertStage4 = mysqli_query($link, $insertStage4);
     }
}
