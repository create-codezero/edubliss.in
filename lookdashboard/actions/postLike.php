<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (isset($_POST['post_id'])) {
     $post_id = $_POST['post_id'];
     $oldHeartCount = $_POST['oldHeartCount'];
     $userUniqueCode = $_SESSION['userUniqueCode'];


     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;



     $check = "SELECT * FROM `78000_postheart` WHERE `userUniqueCode` = '$userUniqueCode' AND `postId` = '$post_id'";
     $check_fire = mysqli_query($link, $check);
     if (mysqli_num_rows($check_fire) > 0) {
          $sql = "DELETE FROM `78000_postheart` WHERE `userUniqueCode` = '$userUniqueCode' AND `postId` = '$post_id'";
          $fire = mysqli_query($link, $sql);

          $nowHeartCount = $oldHeartCount - 1;

          $updateOnPostTable = "UPDATE `78000_posts` SET `totalLike`='$nowHeartCount' WHERE postSrNo = '$post_id'";
          $fireUpdateOnePostTable = mysqli_query($link, $updateOnPostTable);

          echo $nowHeartCount;
     } else {
          $sql = "INSERT INTO `78000_postheart`(`userUniqueCode`, `postId`, `heartTime`) VALUES ('$userUniqueCode','$post_id','$dateTime')";
          $fire = mysqli_query($link, $sql);

          $nowHeartCount = $oldHeartCount + 1;

          $updateOnPostTable = "UPDATE `78000_posts` SET `totalLike`='$nowHeartCount' WHERE postSrNo = '$post_id'";
          $fireUpdateOnePostTable = mysqli_query($link, $updateOnPostTable);

          if ($fireUpdateOnePostTable) {

               $userFullName = $_SESSION['userDetails'][1];

               $notificationText = $userFullName . " like your post. ";

               $gettingPostUserDetails = "SELECT `userId`, `userUniqueCode` FROM `78000_posts` WHERE `postSrNo` = '$post_id'";

               $fireGettingPostUserDetails = mysqli_query($link, $gettingPostUserDetails);

               if (mysqli_num_rows($fireGettingPostUserDetails) > 0) {
                    while ($postUserDetails = mysqli_fetch_row($fireGettingPostUserDetails)) {
                         $postUserId = $postUserDetails['0'];
                         $postUserUniCode = $postUserDetails['1'];
                    }
               }

               $onClick = "notificationLoad('" . 'Profile-post' . $post_id . "')";

               $addUpdateNotification = 'INSERT INTO `78000_update_notification`(`updateNotificationText`, `updateNotificationHref`, `updateNotificationOnClick`, `updateNotificationUserId`, `updateNotificationUserUniqueCode`, `updateNotificationTime`, `updateNotificationShown`) VALUES ("' . $notificationText . '","javascript:void(0)"," ' . $onClick . ' ","' . $postUserId . '","' . $postUserUniCode . '","' . $dateTime . '","0")';
               $fireAddUpdateNotification = mysqli_query($link, $addUpdateNotification);

               echo $nowHeartCount;
          }
     }
}
