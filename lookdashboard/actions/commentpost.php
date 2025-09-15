<?php
session_start();
require_once "../../connect/connectDb/config.php";

if (isset($_POST['commentSubmited'])) {
     $commentText = mysqli_escape_string($link, htmlentities($_POST['commentValue']));
     $commentPost = mysqli_escape_string($link, htmlentities($_POST['commentPost']));
     $userUniqueCode = $_SESSION['userUniqueCode'];

     $userName = $_SESSION['userDetails'][1];
     $userId = $_SESSION['userDetails'][0];
     $userLogo = $_SESSION['userDetails'][9];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $insertingComment = "INSERT INTO `78000_postcomment`(`commentText`, `postId`, `userName`, `userLogo`, `userId`, `commentTime`) VALUES ('$commentText', '$commentPost', '$userName','$userLogo','$userId','$dateTime')";
     $fireInsertingComment = mysqli_query($link, $insertingComment);

     if ($fireInsertingComment) {

          $userFullName = $_SESSION['userDetails'][1];

          $notificationText = $userFullName . " Commented on your post : " . $commentText;

          $gettingPostUserDetails = "SELECT `userId`, `userUniqueCode` FROM `78000_posts` WHERE `postSrNo` = '$commentPost'";

          $fireGettingPostUserDetails = mysqli_query($link, $gettingPostUserDetails);

          if (mysqli_num_rows($fireGettingPostUserDetails) > 0) {
               while ($postUserDetails = mysqli_fetch_row($fireGettingPostUserDetails)) {
                    $postUserId = $postUserDetails['0'];
                    $postUserUniCode = $postUserDetails['1'];
               }
          }

          $onClick = "notificationLoad('" . 'Profile-post' . $commentPost . "')";

          $addUpdateNotification = 'INSERT INTO `78000_update_notification`(`updateNotificationText`, `updateNotificationHref`, `updateNotificationOnClick`, `updateNotificationUserId`, `updateNotificationUserUniqueCode`, `updateNotificationTime`, `updateNotificationShown`) VALUES ("' . $notificationText . '","javascript:void(0)"," ' . $onClick . ' ","' . $postUserId . '","' . $postUserUniCode . '","' . $dateTime . '","0")';
          $fireAddUpdateNotification = mysqli_query($link, $addUpdateNotification);

          echo "Comment Added!";
     } else {
          echo "Comment not submitted due to some Problem!";
     }
}
