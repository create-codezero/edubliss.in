<?php
session_start();
require_once '../../connect/connectDb/config.php';

if (isset($_POST['clearUpdateNotification'])) {

     if (isset($_SESSION['userDetails'])) {

          $clearUpdateNotification = "UPDATE `78000_update_notification` SET `updateNotificationShown`='1' WHERE `updateNotificationUserUniqueCode` = '" . $_SESSION['userUniqueCode'] . "'";

          $fireClearUpdateNotification = mysqli_query($link, $clearUpdateNotification);

          if ($fireClearUpdateNotification) {
               echo 1;
          } else {
               echo 0;
          }
     } else {
          echo 0;
     }
}
