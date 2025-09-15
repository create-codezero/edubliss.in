<?php
session_start();
require_once '../connect/connectDb/config.php';
$verificationStatus = "";

if (isset($_GET['userEmail']) && isset($_GET['vCode'])) {
     $userEmail = $_GET['userEmail'];
     $vCode = $_GET['vCode'];

     $check = "SELECT * FROM `78000_user` WHERE `userEmail` = '$userEmail'";
     $check_fire = mysqli_query($link, $check);

     while ($a = mysqli_fetch_assoc($check_fire)) {
          $userUniCode = $a['userUniqueCode'];
          $userverified = $a['userVerified'];

          if ($userverified == 0) {
               $verifiednow = 1;
               $q = "UPDATE `78000_user` SET `userVerified` = '$verifiednow' WHERE `userEmail` = '$userEmail' AND `userVerificationCode` = '$vCode'";
               $q2 = "UPDATE `78000_notification` SET `notificationSeen` = '$verifiednow' WHERE `notifyUserUniCode` = '$userUniCode'";
               $fire_q = mysqli_query($link, $q);
               $fire_q2 = mysqli_query($link, $q2);
               $verificationStatus = "VerifiedNow";

               if (isset($_SESSION['userDetails'])) {
                    $_SESSION['userDetails'][6] = "1";
               }
          } else if ($userverified == 1) {
               $verificationStatus = "AlreadyVerified";
          }
     }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Email Verification -- Stumitra</title>
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>">
     <link rel="icon" href="../media/Icons/logo.png">
</head>

<body>

     <?php

     if ($verificationStatus == "VerifiedNow") {
          echo
          '
          <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="#"><img src="../media/Icons/logo.png" alt="Logo" class="logo" style="max-height:45px;"></a>
<a href="#" class="m-l-10 img-fluid"><img src="../media/Icons/stumitra.png" alt="Yas Tiwari" class="yastiwari" style="max-height:35px;"></a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../user/auth/signout/">
                         Sign In
                    </a>
               </div>
          </div>
          </div>
          <div class="sector grid h-100vh grid-column-2 tab-grid-column-1 tab-grid-column-1 mob-p-y-20" id="course">

          <div class="flex e-c m-x-100 mob-m-x-50 tab-m-x-100">

               <img src="../media/Illustrations/Verified.png" alt="Illustration" class="img-fluid">

          </div>

          <div class="flex e-c">
               <div class="m-x-100 mob-m-x-30 tab-tx-center">
                    <h1 class="heading fc-primary">You are Verified Now!</h1>
                    <p class="small-sub-heading m-y-10px fc-dark-blue">Thanks For Registring on Stumitra. Sign In Again or Refresh your Dashboard Page to take full Access.</p>
                    <div class="tab-m-y-10"></div>
                    <a class="btn btn-gra-blue tab-m-auto m-y-10" href="../user/auth/signout/">Sign In</a>
               </div>
          </div>

          </div>
          ';
     } else if ($verificationStatus == "AlreadyVerified") {
          echo
          '
          <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="#"><img src="../media/Icons/logo.png" alt="Logo" class="logo" style="max-height:45px;"></a>
<a href="#" class="m-l-10 img-fluid"><img src="../media/Icons/stumitra.png" alt="Yas Tiwari" class="yastiwari" style="max-height:35px;"></a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../user/auth/signin/">
                         Sign In
                    </a>
               </div>
          </div>
          </div>
          <div class="sector grid h-100vh grid-column-2 tab-grid-column-1 tab-grid-column-1 mob-p-y-20" id="course">

          <div class="flex e-c m-x-100 mob-m-x-50 tab-m-x-100">

               <img src="../media/Illustrations/Verified.png" alt="Illustration" class="img-fluid">

          </div>

          <div class="flex e-c">
               <div class="m-x-100 mob-m-x-30 tab-tx-center">
                    <h1 class="heading fc-primary">You are Already Verified!</h1>
                    <p class="small-sub-heading m-y-10px fc-dark-blue">Thanks For Registring on Stumitra. Sign In Again or Refresh your Dashboard Page to take full Access.</p>
                    <div class="tab-m-y-10"></div>
                    <a class="btn btn-gra-blue tab-m-auto m-y-10" href="../user/auth/signin/">Sign In</a>
               </div>
          </div>

          </div>
          ';
     } else if ($verificationStatus == "NotVerified") {
          echo
          '
          <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="#"><img src="../media/Icons/logo.png" alt="Logo" class="logo" style="max-height:45px;"></a>
<a href="#" class="m-l-10 img-fluid"><img src="../media/Icons/stumitra.png" alt="Yas Tiwari" class="yastiwari" style="max-height:35px;"></a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../user/auth/signin/">
                         Sign In
                    </a>
               </div>
          </div>
          </div>
          <div class="sector grid h-100vh grid-column-2 tab-grid-column-1 tab-grid-column-1 mob-p-y-20" id="course">

          <div class="flex e-c m-x-100 mob-m-x-50 tab-m-x-100">

               <img src="../media/Illustrations/Verified.png" alt="Illustration" class="img-fluid">

          </div>

          <div class="flex e-c">
               <div class="m-x-100 mob-m-x-30 tab-tx-center">
                    <h1 class="heading fc-primary">Error!</h1>
                    <p class="small-sub-heading m-y-10px fc-dark-blue">Thanks For Registring on Stumitra. Sign In Again or Refresh your Dashboard Page to take full Access.</p>
                    <div class="tab-m-y-10"></div>
                    <a class="btn btn-gra-blue tab-m-auto m-y-10" href="../user/auth/signin/">Sign In</a>
               </div>
          </div>

          </div>
          ';
     }

     ?>



</body>

</html>