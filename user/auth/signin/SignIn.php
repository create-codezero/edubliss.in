<?php
session_start();
require_once "../../../connect/connectDb/config.php";
$errors = array();

// CHECKING ALREADY LOGIN DETAILS 
if (isset($_POST['takemein'])) {
     if (isset($_COOKIE['userEmail']) && isset($_COOKIE['userPassword'])) {
          $_POST['Email'] = $_COOKIE['userEmail'];
          $_POST['Password'] = $_COOKIE['userPassword'];
          $_POST['SignIn'] = "set";
     }
}


// LOGIN USER
if (isset($_POST['SignIn'])) {
     $Email = mysqli_real_escape_string($link, $_POST['Email']);
     $Password = mysqli_real_escape_string($link, $_POST['Password']);


     if (empty($Email)) {
          array_push($errors, "Username is required");
          header('location: ../User/Auth/SignIn/');
     }
     if (empty($Password)) {
          array_push($errors, "Password is required");
          header('location: ../User/Auth/SignIn/');
     }

     if (count($errors) == 0) {
          if (!isset($_POST['takemein'])) {
               $Password = md5($Password);
          }
          $query = "SELECT * FROM 78000_user WHERE userEmail='$Email' AND userPassword='$Password'";
          $results = mysqli_query($link, $query);

          if (mysqli_num_rows($results) == 1) {



               // SETTING COOKIES FOR NEXT SMOOTH LOGIN

               date_default_timezone_set('Asia/Calcutta');
               setcookie("userEmail", $Email, time() + (86400 * 30), '/');
               setcookie("userPassword", $Password, time() + (86400 * 30), '/');

               // COOKIES SETTED ABOVE

               //SAVING USER DATA IN TO VARIABLE

               while ($a = mysqli_fetch_assoc($results)) {
                    $userFullName = $a['userFullName'];
                    $userUniqueCode = $a['userUniqueCode'];
                    $userDetails = array($a['userId'], $a['userFullName'], $a['userEmail'], $a['userPlan'], $a['userVerificationCode'], $a['userUniqueCode'], $a['userVerified'], $a['mode'], $a['mode_asked'], $a['userLogo'], $a['userPhone'], $a['userStatus']);
               }

               // SAVING USER DATA FROM VARIABLES TO SESSIONS
               $_SESSION['userDetails'] = $userDetails;
               $_SESSION['userFullName'] = $userFullName;
               $_SESSION['userUniqueCode'] = $userUniqueCode;



               //Redirecting User to Dashborad
               if (!isset($_SESSION['pathishere'])) {
                    header('location: ../../../dashboard/');
               } else {
                    $path = $_SESSION['pathishere'];
                    header('location: ' . $path . '');
               }
          } else {

               // If no user Found

               $_SESSION['wrong'] = "Wrong username/password combination";
               header('location: ./');
          }
     }
} else {
     echo "here without clicking on button :) very bad manner ";
     header('location: ../../../');
}
