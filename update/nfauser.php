<?php
session_start();
require_once '../connect/connectDb/config.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$done = "Started ...        ";

$q = "SELECT * FROM `78000_user` WHERE 1";
$fire_q = mysqli_query($link, $q);

if (mysqli_num_rows($fire_q) > 0) {

     while ($a = mysqli_fetch_assoc($fire_q)) {

          $notificationmms = array('Your Email is not Verified. Click Verify to verify your Email.', 'javascript:void(0)', '2', 'Verify', "clickOn('verification-pop')", 'Clear', 'clearThisNotification(this)', '');

          $verificationnotification = 'INSERT INTO `78000_notification`(`notificationText`, `notificationHref`, `notificationActionCount`, `notificationAction1`, `notificationDoAction1`, `notificationAction2`, `notificationDoAction2`, `notificationSuccessMsg`, `notifyUserId`, `notifyUserUniCode`) VALUES ("' . $notificationmms[0] . '","' . $notificationmms[1] . '",' . $notificationmms[2] . ',"' . $notificationmms[3] . '","' . $notificationmms[4] . '","' . $notificationmms[5] . '","' . $notificationmms[6] . '","' . $notificationmms[7] . '",' . $a['userId'] . ',"' . $a['userUniqueCode'] . '")';
          $fire_q2 = mysqli_query($link, $verificationnotification);

          if ($fire_q2) {
               $done .= "User" . $unicode . "notification Done           ";
          }
     }

     echo $done;
}
