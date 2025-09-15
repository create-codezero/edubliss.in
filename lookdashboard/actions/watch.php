<?php
session_start();
require_once "../../connect/connectDb/config.php";


// ADDING 1 COIN TO USER AND REMOVING 0.2 COIN FROM VIDEO 
// THIS IS FOR FIRST ONE MINUTE WATCH

if (isset($_POST['watchedMin'])) {
     $videoId = mysqli_escape_string($link, htmlentities($_POST['videoId']));

     // GETTING THE VIDEO DETAILS
     $findVideo = "SELECT * FROM `78000_videos` WHERE `videoUniCode` = '" . $videoId . "'";
     $fireFindVideo = mysqli_query($link, $findVideo);

     if (mysqli_num_rows($fireFindVideo) > 0) {
          while ($rows = mysqli_fetch_assoc($fireFindVideo)) {
               $videoTitle = $rows['videoTitle'];
               $videoDescription = $rows['videoDescription'];
               $videoTags = $rows['videoTags'];
               $videoLink = $rows['videoLink'];
               $videoThumbnail = $rows['videoThumbnail'];
               $videoCategory = $rows['videoCategory'];
               $channelId = $rows['channelId'];
               $channelUniCode = $rows['channelUniCode'];
               $channelName = $rows['channelName'];
               $channelLogo = $rows['channelLogo'];
               $channelDesc = $rows['channelDesc'];
               $videoImpressions = $rows['videoImpressions'];
               $videoViews = $rows['videoViews'];
               $videoCtr = $rows['videoCtr'];
               $videoWatchtime = $rows['videoWatchtime'];
          }
     }

     $nowViews = $videoViews + 1;
     $nowVideoWatchtime = $videoWatchtime + 1;

     $videoUpdateQuery = "UPDATE `78000_videos` SET `videoViews`='$nowViews', `videoWatchtime`='$nowVideoWatchtime' WHERE videoUniCode = '$videoId'";
     $fireVideoUpdateQuery = mysqli_query($link, $videoUpdateQuery);


}


// REMOVING 0.2 COIN FROM VIDEO 
// THIS IS FOR OTHER ONE MINUTE WATCH

if (isset($_POST['watchedAnotherMin'])) {
     $videoId = $_POST['videoId'];

     // GETTING THE VIDEO DETAILS
     $findVideo = "SELECT * FROM `78000_videos` WHERE `videoUniCode` = '" . $videoId . "'";
     $fireFindVideo = mysqli_query($link, $findVideo);

     if (mysqli_num_rows($fireFindVideo) > 0) {
          while ($rows = mysqli_fetch_assoc($fireFindVideo)) {
               $videoTitle = $rows['videoTitle'];
               $videoDescription = $rows['videoDescription'];
               $videoTags = $rows['videoTags'];
               $videoLink = $rows['videoLink'];
               $videoThumbnail = $rows['videoThumbnail'];
               $videoCategory = $rows['videoCategory'];
               $channelId = $rows['channelId'];
               $videoImpressions = $rows['videoImpressions'];
               $videoViews = $rows['videoViews'];
               $videoCtr = $rows['videoCtr'];
               $videoWatchtime = $rows['videoWatchtime'];
          }
     }

     $nowVideoWatchtime = $videoWatchtime + 1;

     $videoUpdateQuery = "UPDATE `78000_videos` SET  `videoWatchtime`='$nowVideoWatchtime' WHERE videoUniCode = '$videoId'";
     $fireVideoUpdateQuery = mysqli_query($link, $videoUpdateQuery);
}


// SAVING THE FEEDBACK
if (isset($_POST['feedback'])) {
     $userFullName = mysqli_escape_string($link, htmlentities($_POST['userFullName']));
     $videoId = mysqli_escape_string($link, htmlentities($_POST['videoId']));
     $feedbackMessage = mysqli_escape_string($link, htmlentities($_POST['feedbackMessage']));
     $videoChannelId = mysqli_escape_string($link, htmlentities($_POST['videoChannelId']));
     $userUniCode = mysqli_escape_string($link, htmlentities($_POST['userUniCode']));


     $userLogo = $_SESSION['userDetails'][9];
     $userId = $_SESSION['userDetails'][0];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;


     // SAVING THE FEEDBACK
     $saveFeedbackQuery = "INSERT INTO `78000_video_feedbacks`(`message`, `fullName`, `userUniCode`, `userId`, `userLogo`, `videoId`, `videoChannelId`, `feedbackTime`) VALUES ('$feedbackMessage','$userFullName','$userUniCode','$userId','$userLogo','$videoId','$videoChannelId','$dateTime')";
     $fireSaveFeedbackQuery = mysqli_query($link, $saveFeedbackQuery);

     if ($fireSaveFeedbackQuery) {
          echo "Your Feedback has been sent successfully!";
     }
}

if (isset($_POST['uploadVideo'])) {

     // GETTING POST TEXT DATA
     $videoTitle = mysqli_escape_string($link, htmlentities($_POST['videoTitle']));
     $videoDescription = mysqli_escape_string($link, htmlentities($_POST['videoDescription']));
     $videoTags = mysqli_escape_string($link, htmlentities($_POST['videoTags']));
     $videoCategory = $_POST['videoCategory'];
     $videoLink = mysqli_escape_string($link, htmlentities($_POST['videoLink']));
     $coin = $_POST['coin'];
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

     $checkingVideoIsNewQuery = "SELECT * FROM `78000_videos` WHERE videoUniCode = '$videoId'";
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
               $filename = compress_image($temp_name, "../../data/user/videothumbnail/" . $file_name, 20);
               if ($filename = "Image uploaded successfully.") {
                    $videoThumbnail = $file_name;
               }
          } else {
               echo "Uploaded image should be jpg, jpeg or png.";
          }

          // USER UNI CODE
          $videoUserUniCode = $_SESSION['userUniqueCode'];

          // GETTING CHANNEL DETAILS

          // CREATING GLOBAL VARIABLES
          $channelId = "";
          $channelUniCode = "";
          $channelName = "";
          $channelLogo = "";
          $channelDesc = "";

          $remainingCoins = "";
          $totalCoinSpent = "";

          // FETCHING FROM DATABASE
          $channelDetailQuery = "SELECT * FROM `78000_channels` WHERE channelUser = '" . $_SESSION['userUniqueCode'] . "'";
          $fireChannelDetailQuery = mysqli_query($link, $channelDetailQuery);

          if (mysqli_num_rows($fireChannelDetailQuery) > 0) {
               while ($channelDetailRow = mysqli_fetch_assoc($fireChannelDetailQuery)) {
                    $channelId = $channelDetailRow['channelId'];
                    $channelUniCode = $channelDetailRow['channelUniCode'];
                    $channelName = $channelDetailRow['channelName'];
                    $channelLogo = $channelDetailRow['logoLink'];
                    $channelDesc = $channelDetailRow['channelDesc'];
                    $remainingCoins = $channelDetailRow['remainingCoin'];
                    $totalCoinSpent = $channelDetailRow['totalCoinSpent'];
               }
          } else {
               header('location: ../');
          }




          // SAVING IN DATABASE

          $saveInDatabaseQuery = "INSERT INTO `78000_videos`(`videoTitle`, `videoDescription`, `videoTags`, `videoLink`, `videoUniCode`, `videoThumbnail`, `videoCategory`, `channelId`, `channelUniCode`, `channelName`, `channelLogo`, `channelDesc`, `videoUserUniCode`, `totalCoins`, `remainingCoins`, `uploadTime`) VALUES ('$videoTitle','$videoDescription','$videoTags','$videoLink','$videoId','$videoThumbnail','$videoCategory','$channelId','$channelUniCode','$channelName','$channelLogo','$channelDesc','$videoUserUniCode','$coin','$coin','$dateTime')";
          $fireSaveInDatabaseQuery = mysqli_query($link, $saveInDatabaseQuery);

          // REDUCING TOTAL COIN AND ADDING COIN SPENT IN CHANNEL

          $nowRemainingCoin = $remainingCoins - $coin;
          $nowSpentCoin = $totalCoinSpent + $coin;

          $channelQuery = "UPDATE `78000_channels` SET `totalCoinSpent`='$nowSpentCoin',`remainingCoin`='$nowRemainingCoin' WHERE channelUser = '" . $_SESSION['userUniqueCode'] . "'";
          $fireChannelQuery = mysqli_query($link, $channelQuery);

          if ($fireChannelDetailQuery && $fireChannelQuery) {
               $_SESSION['remainingCoin'] = $nowRemainingCoin;
               header('location: ../Your-Videos');
          } else {
               header('location: ../Video-Details');
          }
     } else {
          $_SESSION['videoAlreadyExist'] = "Video Already Exist!";
          header('location: ../Video-Details');
     }
}


if (isset($_POST['countAView'])) {
     $viewCount = $_POST['viewCount'] + 1;
     if($_POST['type'] == "Video"){
          $id = $_POST['videoId'];
          $addViewQuery = "UPDATE `78000_videos` SET `videoViews`='$viewCount' WHERE videoId = '$id'";
          $fireAddViewQuery = mysqli_query($link, $addViewQuery);

     }else if($_POST['type'] == "Playlist"){
          $id = $_POST['playlistId'];
          $addViewQuery = "UPDATE `78000_playlists` SET `playlistViews`='$viewCount' WHERE playlistLink = '$id'";
          $fireAddViewQuery = mysqli_query($link, $addViewQuery);
     }


     $userUniqueCode = 0;

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $addingWatchHistory = "INSERT INTO `78000_watch_history`(`watchHistoryUser`, `watchHistoryVideoId`, `watchHistoryTime`) VALUES ('$userUniqueCode','$videoId','$dateTime')";

     $fireAddingWatchHistory = mysqli_query($link, $addingWatchHistory);
}


if (isset($_POST['editVideo'])) {

     // GETTING POST TEXT DATA
     $videoTitle = mysqli_escape_string($link, htmlentities($_POST['videoTitle']));
     $videoDescription = mysqli_escape_string($link, htmlentities($_POST['videoDescription']));
     $videoTags = mysqli_escape_string($link, htmlentities($_POST['videoTags']));
     $videoCategory = $_POST['videoCategory'];
     $videoThumbnail = "";

     // GETTING THE VIDEO ID
     $videoId = $_POST['videoId'];

     if (!empty($_FILES['thumbnailFile']['name']) || $_FILES['thumbnailFile']['size'] != 0) {

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
               $filename = compress_image($temp_name, "../../data/user/videothumbnail/" . $file_name, 20);
               if ($filename = "Image uploaded successfully.") {
                    $videoThumbnail = $file_name;
               }
          } else {
               echo "Uploaded image should be jpg, jpeg or png.";
          }
     } else if (!empty($_POST['oldThumbnailFile'])) {
          $videoThumbnail = mysqli_real_escape_string($link, $_POST['oldThumbnailFile']);
     } else {
          header('location: ../');
     }

     // UPDATING IN DATABASE

     $updateInDatabaseQuery = "UPDATE `78000_videos` SET `videoTitle`='$videoTitle',`videoDescription`='$videoDescription',`videoTags`='$videoTags',`videoThumbnail`='$videoThumbnail',`videoCategory`='$videoCategory' WHERE videoUniCode = '$videoId'";
     $fireUpdateInDatabaseQuery = mysqli_query($link, $updateInDatabaseQuery);

     if ($fireUpdateInDatabaseQuery) {
          header('location: ../Your-Videos');
     } else {
          header('location: ../Video-Details');
     }
}
