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
          $verificationCode = bin2hex(random_bytes(16));
          $fullName = $a['userFullName'];
          $userfullname = str_replace(' ', '', $fullName);
          $userfullnametosmallletter = strtolower($userfullname);

          $unicode = $a['userId'];

          $uniqueCode = $userfullnametosmallletter . "78" . $unicode . "00";

          $q2 = "UPDATE `78000_user` SET `userVerificationCode`='$verificationCode',`userUniqueCode`='$uniqueCode' WHERE `userId` = '$unicode'";
          $fire_q2 = mysqli_query($link, $q2);

          if ($fire_q2) {
               $done .= "User" . $unicode . "Done           ";
          }
     }

     echo $done;
}
