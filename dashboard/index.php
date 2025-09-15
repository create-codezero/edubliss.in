<?php
session_start();
require_once '../connect/connectDb/config.php';
require_once "../connect/function/timeago.php";

if (!isset($_SESSION['userFullName'])) {
     header('location: ../');
}
if (isset($_GET)) {
     foreach ($_GET as $data => $val) {
          $title = mysqli_real_escape_string($link, $data);
          $title = str_replace('/', '', $title);

          if (strpos($title, 'play-') !== false) {
               $vidId = str_replace('play-', '', $title);
               $title = str_replace('play-', 'watch.php?videoId=', $title);
          }else if(strpos($title, 'playlist_') !== false) {
               $vidId = str_replace('playlist_', '', $title);
               $title = str_replace('playlist_', 'Playlist.php?playlistId=', $title);
          } else if (strpos($title, 'feedbacks-') !== false) {
               $vidId = str_replace('feedbacks-', '', $title);
               $title = str_replace('feedbacks-', 'feedbacks.php?videoId=', $title);
          } else if (strpos($title, 'edit-') !== false) {
               $vidId = str_replace('edit-', '', $title);
               $title = str_replace('edit-', 'edit.php?videoId=', $title);
          }else if(strpos($title, 'Assignment-Subjects_') !== false){
               $aWeekId = str_replace('Assignment-Subjects_', '', $title);
               $title = str_replace('Assignment-Subjects_', 'Assignment-Subjects.php?aWeekId=', $title);
          }else if(strpos($title, 'A-Question_') !== false){
               $getData = str_replace('A-Question_', '', $title);
               $getDataArray = explode("_",$getData);
               $aWeekId = $getDataArray[0];
               $aSubjectId = $getDataArray[1];

               $furl = 'A-Question.php?aWeekId='.$aWeekId.'&aSubjectId='. $aSubjectId;

               $title = $furl;
          }
          $firstLetter = substr($title, 0, 1);
          $firstLetter = strtoupper($firstLetter);
          $length = strlen($title) - 1;
          $otherLetter = substr($title, 1, $length);
          $pathis = $firstLetter . $otherLetter;
     }
}
if (empty($data)) {
     if (isset($_SESSION['path'])) {
          $pathis = $_SESSION['path'];
     } else {
          $pathis = "Home";
     }
}

$userUniqueCode = $_SESSION['userUniqueCode'];
$haveNotification = "False";


$_SESSION['visited'] = array();


$noticationq = "SELECT * FROM 78000_notification WHERE notifyUserUniCode='$userUniqueCode' AND notificationSeen='0'";
$fnotificationq = mysqli_query($link, $noticationq);
if (mysqli_num_rows($fnotificationq) > 0) {
     $haveNotification = "True";
} else if (isset($_SESSION['reg_success'])) {
     $haveNotification = "True";
}

$gettingUpdateNotification = "SELECT * FROM `78000_update_notification` WHERE updateNotificationUserUniqueCode='$userUniqueCode' ORDER BY `updateNotificationId` DESC LIMIT 0, 29";
$fireGettingUpdateNotification = mysqli_query($link, $gettingUpdateNotification);

if (mysqli_num_rows($fireGettingUpdateNotification) > 0) {
     $haveUpdateNotification = "True";
} else {
     $haveUpdateNotification = "False";
}


?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['userDetails'][7]; ?>">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
     <title>Dashboard -- EDUBLISS</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.3.3/jquery.appear.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>" />

     <!-- Global site tag (gtag.js) - Google Analytics -->

     <link rel="icon" href="../media/Images/LOGO_CIRCLE.png">

</head>

<body>
     <div class="header-box pos-fixed z-2 w-100per" id="header">
          <div class="header">
               <div class="branding">
                    <a href="javascript:void(0)" onclick="clickOn('side-menu')"><img src="../media/Images/menu.png" alt="Logo" class="menu" style="max-width:45px; min-width:45px;"></a>
                    <a href="./Home"><img src="../media/Icons/logo.png" style="height:45px;" alt="Logo" class="logo"></a>
                    <a href="./Home" class="m-l-10 img-fluid">
                         <img src="../media/Icons/edubliss.png" style="height:35px;" alt="EduBliss"  class="edubliss">
                    </a>
               </div>
               <div class="header-menu flex flex-y-center">
                    <a href="javascript:void(0)" id="notificationIcon" onclick="clickOn('notification-pop')">
                         <i class="fa fa-bell fc-secondary
fc-secondary fs-20 pos-relative hover-fc-primary" aria-hidden="true" style="padding: 2px 5px;"><samp style="top:-2px; right:0; font-size:10px; background-color: var(--clr-7); <?php
                                                                                                                                                                               if ($haveNotification == "True" || $haveUpdateNotification == "True") {
                                                                                                                                                                                    echo "padding: 4px; border-radius: 5px;";
                                                                                                                                                                               } else {
                                                                                                                                                                                    echo "";
                                                                                                                                                                               }
                                                                                                                                                                               ?>" class="pos-absolute font-poppins fc-primary fw-400" id="havenoti"></samp></i>
                    </a>
                    <a href="javascript:void(0)" class="m-l-20 fw-500 font-poppins pos-relative flex e-c" style="background-color: var(--primary); border-radius: 100%; color: var(--clr-1);width:35px; height:35px;" onclick="clickOn('user-pop-menu')">
                         <p class="pos-absolute"><?php echo ucwords(substr($_SESSION['userFullName'], 0, 1)); ?></p>
                    </a>
               </div>
          </div>
     </div>

     <div class="block" style="height: 70px;"></div>
     <div class="notTop none" id="notTop">
          <div class="flex e-c m-auto" style="width: 95%;">
               <div class="flex flex-d-column e-c pos-relative" style="max-width: 700px; width:100%;">
                    <div class="w-100per Write-post" id="Write-post-Top" style="margin-bottom: 5px;">

                    </div>
               </div>
          </div>
     </div>

     <!-- Content will Load Here -->

     <div id="Content"></div>

     <!-- Side - Menu -->
     <div class="side-menu bg-white h-100vh none pos-fixed z-1" id="side-menu">

          <div class="menu m-t-80">
               <ul>
                    <!-- <p class="normal-tx fw-500 fc-dark-blue">Your Menu.</p>
                    <div class="bg-primary block m-10" style="height: 2px;"></div> -->

                    <?php
                    if (isset($_SESSION['userFullName'])) {
                         $feature = "feature";
                         $fmenuq = "SELECT * FROM `78000_usermenu` WHERE menuType='$feature'";
                         $fmenu = mysqli_query($link, $fmenuq);
                         while ($menuItems = mysqli_fetch_assoc($fmenu)) {

                              if ($pathis == $menuItems['menuActive']) {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20 active" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              } else {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              }
                         }
                    }
                    ?>
                    <!-- <div class="bg-primary block m-10" style="height: 2px;"></div> -->
                    <!-- <p class="normal-tx fw-500 fc-dark-blue">Settings</p> -->
                    <?php
                    if (isset($_SESSION['userFullName'])) {
                         $service = "service";
                         $fmenuq = "SELECT * FROM `78000_usermenu` WHERE menuType='$service'";
                         $fmenu = mysqli_query($link, $fmenuq);
                         while ($menuItems = mysqli_fetch_assoc($fmenu)) {
                              if ($pathis == $menuItems['menuActive']) {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20 active" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              } else {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              }
                         }
                    }
                    ?>

                    <!-- <div class="bg-primary block m-10" style="height: 2px;"></div> -->
                    <!-- <p class="normal-tx fw-500 fc-dark-blue">Settings</p> -->
                    <?php
                    if (isset($_SESSION['userFullName'])) {
                         $setting = "setting";
                         $fmenuq = "SELECT * FROM `78000_usermenu` WHERE menuType='$setting'";
                         $fmenu = mysqli_query($link, $fmenuq);
                         while ($menuItems = mysqli_fetch_assoc($fmenu)) {
                              if ($pathis == $menuItems['menuActive']) {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20 active" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              } else {
                                   echo ' <li><a href="' . $menuItems['menuHref'] . '" onclick="' . $menuItems['menuDo'] . '" class="nnmenu fc-dark-blue font-poppins fs-20" id="' . $menuItems['menuActive'] . '"><i class="' . $menuItems['menuIcon'] . '"></i> ' . $menuItems['menuText'] . ' </a></li> ';
                              }
                         }
                    }
                    ?>
                    <!-- <div class="bg-primary block m-10" style="height: 2px;"></div> -->
                    <!-- <p class="normal-tx fw-500 fc-dark-blue">I have done my Work.</p> -->
                    <li><a href="../user/auth/signout/" class="fc-dark-blue font-poppins fs-20"><i class="fas fa-sign-out-alt    "></i> Sign Out</a></li>
                    <div class="bg-primary block m-10" style="height: 1px;"></div>
          </div>

          <div class="flex flex-d-column e-c">
               <p class="fs-20 font-poppins m-t-10" style="text-align: left;">Links</p>
               <div class="bg-primary block m-10 " style="height: 1px; width:25%;"></div>

               <div class="links flex font-poppins m-b-10">
                    <p class="tx-center">
                         <a href="javascript:void(0)">About Us</a>
                         <a href="../legal/terms-and-conditions/">Terms of Use</a>
                         <a href="../privacy-policy/">Privacy Policy</a>
                         <a href="../info/our-team/">Our Team</a>
                         <a href="#">Report Bug</a>
                    </p>
               </div>

               <!-- <div class="m-y-10">
                    <div class="bg-clr-1" style="background-color: var(--clr-5); border-radius:10px;">
                         <a href="#"><img src="../media/Icons/full_brand_2.png" alt="Logo" style="max-height:70px;"></a>
                    </div>

               </div> -->

               <div class="m-y-10">
                    <div class="bg-clr-1" style="border-radius:10px;">
                         <a href="javascript:void(0)" download><img src="../media/Icons/footer_logo.png" alt="Download Android App" style="max-height:65px;"></a>
                    </div>

               </div>

               <p class="fs-20 font-poppins m-t-10" style="text-align: left;">Social Media</p>
               <div class="bg-primary block m-10 " style="height: 1px; width:25%;"></div>

               <div class="m-y-10">
                    <div class="flex" id="footer-social-media">
                         <div class="bg-footer-icon">
                              <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                         </div>

                         <div class="bg-footer-icon m-l-10">
                              <a href="https://chat.whatsapp.com/FivLYYWfJnJJnjFvryKCFZ" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                         </div>

                         <div class="bg-footer-icon m-l-10">
                              <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                         </div>

                         <div class="bg-footer-icon m-l-10">
                              <a href="mailto:website.edubliss@gmail.com" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                         </div>

                         <div class="bg-footer-icon m-l-10">
                              <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                         </div>
                    </div>
               </div>

               <div class="sector flex e-c bg-footer-copyright p-y-10">
                    <p class="font-poppins fc-primary tx-center">&copy; · <a href="#" class="fc-secondary"> STUMITRA </a> · All Rights Reserved!</p>
               </div>
          </div>

     </div>

     <!-- User Pop Up -->

     <div class="user-pop-menu z-2 pos-fixed bg-white flex e-c flex-d-column none" id="user-pop-menu">
          <div class="block tx-right w-100per" onclick="clickOn('user-pop-menu')">
               <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
               <hr class="border">
          </div>
          <div class="tx-center user-menu w-100per m-t-10">
               <?php
               if (!empty($_SESSION['userDetails'][9])) {
                    echo '<img src="../data/user/userProfile/' . $_SESSION['userDetails'][9] . '" alt="User Logo" style="width: 25%;">';
               } else {
                    echo '<img src="../media/Images/img_user.png" alt="User Logo" style="width: 25%;">';
               }
               ?>
               <p class="fc-light-dark-blue font-poppins fw-600 fs-25 m-b-10"><?php
                                                                                if (strlen($_SESSION['userFullName']) > 12) {
                                                                                     echo substr($_SESSION['userFullName'], 0, 12) . "...";
                                                                                } else {
                                                                                     echo $_SESSION['userFullName'];
                                                                                } ?></p>

               <ul class="m-t-10">
                    <li><a href="javascript:void(0)" onclick="dashboardLoad('Profile','UserPopUp')">Profile</a></li>
                    <li><a href="../user/auth/signout/">Sign Out</a></li>
               </ul>
          </div>

     </div>
     <!-- notification-pop -->
     <div class="notification-pop z-2 pos-fixed bg-white flex e-c flex-d-column none" id="notification-pop">
          <div class="block tx-right w-100per" onclick="clickOn('notification-pop')">
               <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
               <hr class="border">
          </div>
          <div class="tx-left user-menu w-100per m-t-10">
               <p class="fc-light-dark-blue font-poppins fw-600 fs-25  m-l-10 tx-center">Notifications</p>

               <ul class="notification-ul" style="padding-bottom: 10px;">

                    <?php
                    // reg_success
                    if (isset($_SESSION['reg_success'])) {
                         $noticationq = "SELECT * FROM `78000_reg_notification` WHERE 1";
                         $fnotificationq = mysqli_query($link, $noticationq);
                         while ($notificationItems = mysqli_fetch_assoc($fnotificationq)) {
                              echo '
                              <li class="nnnotification" id="regnoti' . $notificationItems['notificationId'] . '"><a href="' . $notificationItems['notificationHref'] . '">' . $notificationItems['notificationText'] . '<br><br>
                              <!-- notification call-to-action -->
                              <samp class="not-pop-btn fc-primary block m-t-10 z-1" style=" padding: 5px 15px;" onclick="' . $notificationItems['notificationDoAction1'] . '">' . $notificationItems['notificationAction1'] . '</samp>
                              <samp class="not-pop-btn fc-primary block m-t-10 z-1" style=" padding: 5px 15px;" id="' . $notificationItems['notificationId'] . '" onclick="' . $notificationItems['notificationDoAction2'] . '">' . $notificationItems['notificationAction2'] . '</samp>
                              <!-- notification call-to-action -->
                                   </a>
                              </li>
                              ';
                         }
                    }

                    if (isset($_SESSION['userFullName'])) {
                         $noticationq = "SELECT * FROM 78000_notification WHERE notifyUserUniCode='$userUniqueCode' AND notificationSeen='0'";
                         $fnotificationq = mysqli_query($link, $noticationq);
                         while ($notificationItems = mysqli_fetch_assoc($fnotificationq)) {
                              echo '
                              <li class="nnnotification" id="noti' . $notificationItems['notificationId'] . '"><a href="' . $notificationItems['notificationHref'] . '">' . $notificationItems['notificationText'] . '<br><br>
                              <!-- notification call-to-action -->
                              <samp class="not-pop-btn fc-primary block m-t-10 z-1" style="padding: 5px 15px;" onclick="' . $notificationItems['notificationDoAction1'] . '">' . $notificationItems['notificationAction1'] . '</samp>
                              <samp class="not-pop-btn fc-primary block m-t-10 z-1" style=" padding: 5px 15px;" id="' . $notificationItems['notificationId'] . '" onclick="' . $notificationItems['notificationDoAction2'] . '">' . $notificationItems['notificationAction2'] . '</samp>
                              <!-- notification call-to-action -->
                                   </a>
                              </li>
                              ';
                         }


                         // update notification

                         if (mysqli_num_rows($fireGettingUpdateNotification) > 0) {
                              while ($updateNotification = mysqli_fetch_assoc($fireGettingUpdateNotification)) {

                                   if ($updateNotification['updateNotificationShown'] == 0) {
                                        echo '
                              <li onclick="' . $updateNotification['updateNotificationOnClick'] . '" id="noti' . $updateNotification['updateNotificationId'] . '"><a href="' . $updateNotification['updateNotificationHref'] . '">' . $updateNotification['updateNotificationText'] . '<br><div class="flex" style="margin-top:5px;"><spam style="font-size:7px;"> ' . time_elapsed_string($updateNotification['updateNotificationTime']) . '</spam><div style="height:7px; width:7px; background-color:var(--primary); border-radius:100%; margin-left:10px;"></div></div>
                                   </a>
                              </li>
                              ';
                                   } else {
                                        echo '
                              <li onclick="' . $updateNotification['updateNotificationOnClick'] . '" id="noti' . $updateNotification['updateNotificationId'] . '"><a href="' . $updateNotification['updateNotificationHref'] . '">' . $updateNotification['updateNotificationText'] . '<br><div class="flex" style="margin-top:5px;"><spam style="font-size:7px;"> ' . time_elapsed_string($updateNotification['updateNotificationTime']) . '</spam></div>
                                   </a>
                              </li>
                              ';
                                   }
                              }
                         }
                    }
                    ?>
               </ul>
          </div>

     </div>

     <!-- Verification Pop up -->

     <div class="sector z-2 pos-fixed flex e-c flex-d-column h-100vh none" id="verification-pop" style="top: 0; left:0; background-color: var(--shadow-clr);">


          <div class="form-box bg-clr-1 pop-up-box">
               <div class="main-box">
                    <div class="block tx-right w-100per" onclick="clickOn('verification-pop')">
                         <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                         <hr class="bg-dark-blue">
                    </div>
                    <form class="m-t-20">
                         <?php
                         $userDetails = $_SESSION['userDetails'];
                         ?>
                         <p class="fs-20 tx-center" id="mailsentmsg">E-Mail Verification</p>
                         <p class="fs-15 fw-500 mailsenthideit" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                         <div class="input mailsenthideit">
                              <input type="Email" name="email" id="email" placeholder="E-mail" value="<?php echo $userDetails[2]; ?>" class="mailsenthideit" required>
                         </div>

                         <p class="fs-10 tx-center m-t-10 mailsenthideit"> Check your E-mail before Verify It. If you change your email here your email will be changed for always. </p>


                         <a class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" onclick="Verify_Email('<?php echo $userDetails[2]; ?>','<?php echo $userDetails[0]; ?>')" href="javascript:void(0)" id="Verify">Verify</a>
                    </form>
               </div>
          </div>

     </div>

     <!-- This is the dark and light mode query part -->


     <div class="sector z-2 pos-fixed flex e-c flex-d-column h-100vh <?php

                                                                      if ($_SESSION['userDetails'][8] == 1) {
                                                                           echo "none";
                                                                      }
                                                                      ?> " id="verification-mode" style="top: 0; left:0; background-color: var(--shadow-clr);">


          <div class="form-box bg-clr-1 pop-up-box">
               <div class="main-box">
                    <div class="block tx-right w-100per" onclick="clickOn('verification-mode')">
                         <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                         <hr class="bg-dark-blue">
                    </div>
                    <form class="m-t-20">
                         <p class="fs-20 tx-center" id="mailsentmsg">Mode You Like</p>
                         <p class="fs-15 fw-500 mailsenthideit" style="margin-top: 20px; margin-left: 2px;">Select Mode </p>
                         <div class="">
                              <label class="input-container m-t-10">Light
                                   <input type="radio" name="mode" value="light">
                                   <span class="checkmark"></span>
                              </label>

                              <label class="input-container m-t-10">Dark
                                   <input type="radio" name="mode" value="dark">
                                   <span class="checkmark"></span>
                              </label>
                         </div>

                         <p class="fs-10 tx-center m-t-20 mailsenthideit"> You can change this mode anytime you want by just going on profile tab. </p>


                         <a class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" onclick="Mode_Query('<?php echo $_SESSION['userDetails'][0]; ?>')" href="javascript:void(0)" id="Set">Select</a>
                    </form>
               </div>
          </div>

     </div>


     <!-- Loading Animation -->
     <div id="loading" class="">
          <div class="loading-screen"></div>
          <div class="loading-icon">
               <img src="../media/svg/loading.svg" alt="Loading">
          </div>
     </div>


     <!-- Scrips  -->
     <script src="../js/actions.js"></script>
     <script>

          <?PHP

          if(isset($_SESSION['notifyWorkDone'])){
               echo "alert(".'"'.$_SESSION['notifyWorkDone'].'"'.");";

               unset($_SESSION["notifyWorkDone"]);
          }

          ?>

          let totalnoti;
          $(document).ready(function() {
               <?php
               if (strpos($pathis, '.php') !== false) {
                    echo '$("#Content").load("./pages/' . $pathis . '");';
               } else {
                    echo '$("#Content").load("./pages/' . $pathis . '.php");';
               }
               ?>

               $(`#Content`).ready(function() {
                    $(`#loading`).toggleClass("none");
               });

               totalnoti = $('.nnnotification').length;

          });

          function inputShouldContain(e) {
               var eId = e.id;
               var eIdNum = eId.charAt(eId.length - 1);
               $(`#poll${eIdNum}`).toggleClass("wrong");
               document.getElementById(eId).removeAttribute('onchange');
          }

          function submitPost() {

               var PostText = $("#postText").val();
               var Polling = $("#polling").val();

               if (Polling != "" && Polling != null) {

                    var i = 1;
                    while (i <= Polling) {
                         if ($(`#pollInput${i}`).val() != "" && $(`#pollInput${i}`).val() != null) {

                         } else {
                              var oldPollClass = document.getElementById(`poll${i}`).getAttribute('class');
                              if (oldPollClass.includes("wrong") == false) {
                                   $(`#poll${i}`).toggleClass("wrong");
                                   document.getElementById(`pollInput${i}`).setAttribute('onchange', "inputShouldContain(this)");
                              }
                              return;
                         }
                         i++;
                    }

                    if (PostText != "" && PostText != null) {
                         $(`#loading`).toggleClass("none");

                         const writePostForm = document.getElementById('writePostForm');

                         var fileSelect = document.getElementById('Upload-Post-Image');
                         // Get the files from the input
                         var files = fileSelect.files;

                         // Create a FormData object.
                         var fd = new FormData(writePostForm);

                         //Grab only one file since this script disallows multiple file uploads.
                         var file = files[0];

                         if (file) {

                              if (file.size >= 2000000) {
                                   alert('You cannot upload this file because its size exceeds the maximum limit of 2 MB.');
                                   return;
                              }

                              // Check file selected or not
                              if (file.name.length > 0) {
                                   fd.append('postPhoto', file);
                              }
                         }

                         $.ajax({
                              url: '../dashboard/actions/submitPost.php',
                              type: 'post',
                              data: fd,
                              contentType: false,
                              processData: false,
                              success: function(data) {
                                   if (data == "Posted Successfully!") {
                                        if (notTopNewPost == "True") {
                                             $("#notTop").toggleClass('none');
                                             notTopNewPost = "False";
                                             $(`#loading`).toggleClass("none");
                                        }
                                        $("#Write-post").load("./component/write-post.html", function() {
                                             alert("Posted Successfully!");
                                             $(`#loading`).toggleClass("none");
                                        });
                                   }
                              },
                         });

                    } else {
                         alert("Please Write Something Before Post.");
                    }

               } else {
                    if (PostText != "" && PostText != null) {
                         $(`#loading`).toggleClass("none");
                         const writePostForm = document.getElementById('writePostForm');

                         var fileSelect = document.getElementById('Upload-Post-Image');
                         // Get the files from the input
                         var files = fileSelect.files;

                         // Create a FormData object.
                         var fd = new FormData(writePostForm);

                         //Grab only one file since this script disallows multiple file uploads.
                         var file = files[0];

                         if (file) {

                              if (file.size >= 2000000) {
                                   alert('You cannot upload this file because its size exceeds the maximum limit of 2 MB.');
                                   return;
                              }

                              // Check file selected or not
                              if (file.name.length > 0) {
                                   fd.append('postPhoto', file);
                              }
                         }

                         $.ajax({
                              url: '../dashboard/actions/submitPost.php',
                              type: 'post',
                              data: fd,
                              contentType: false,
                              processData: false,
                              success: function(data) {
                                   if (data == "Posted Successfully!") {
                                        if (notTopNewPost == "True") {
                                             $("#notTop").toggleClass('none');
                                             notTopNewPost = "False";
                                             $(`#loading`).toggleClass("none");
                                        }
                                        $("#Write-post").load("./component/write-post.html", function() {
                                             alert("Posted Successfully!");
                                             $(`#loading`).toggleClass("none");
                                        });
                                   }
                              },
                         });

                    } else {
                         alert("Please Write Something Before Post.");
                    }
               }


          }

          function votePoll(e) {
               let post = e.getAttribute('data-post');
               let pollNum = e.getAttribute('data-pollNum');

               $.post('./actions/votePoll.php', {
                         voteThis: "set",
                         post: post,
                         pollNum: pollNum
                    },
                    function(data, status) {
                         if (data.length > 400) {
                              document.getElementById(`postPoll${post}`).innerHTML = data;
                         }
                    });
          }

          function removePollInput(e) {
               var pollNumber = e.getAttribute('data-pollNum');
               const element = document.getElementById(`poll${pollNumber}`);
               element.remove();

               if (parseInt(pollNumber) == 3) {
                    var clickedElement = document.getElementById("Add-One-More-Poll");
                    clickedElement.setAttribute('onclick', "addMorePollInput()");

                    const poll4 = document.getElementById("poll4");
                    if (poll4) {
                         clickedElement.setAttribute('data-pollNum', "4");
                         poll4.setAttribute('id', `poll${pollNumber}`);

                         const pollInput4 = document.getElementById("pollInput4");
                         pollInput4.setAttribute('name', `poll${pollNumber}`);
                         pollInput4.setAttribute('id', `pollInput${pollNumber}`);
                         document.getElementById('polling').setAttribute('value', "3");
                         const pollRemover4 = document.getElementById("pollRemover4")
                         pollRemover4.setAttribute('data-pollNum', `3`);
                    } else {
                         clickedElement.setAttribute('data-pollNum', "3");
                         document.getElementById('polling').setAttribute('value', "2");
                    }
               } else if (parseInt(pollNumber) == 4) {
                    var clickedElement = document.getElementById("Add-One-More-Poll");
                    clickedElement.setAttribute('data-pollNum', "4");
                    clickedElement.setAttribute('onclick', "addMorePollInput()");
                    document.getElementById('polling').setAttribute('value', "3");
               }
          }

          function addMorePollInput() {
               var clickedElement = document.getElementById("Add-One-More-Poll");
               var pollNumber = clickedElement.getAttribute('data-pollNum');

               const newPollDiv = document.createElement('div');

               newPollDiv.setAttribute('id', `poll${pollNumber}`);
               newPollDiv.setAttribute('class', "pos-relative poll");
               newPollDiv.setAttribute('style', "margin-top: 5px;");

               document.getElementById("pollInputContainer").append(newPollDiv);

               document.getElementById(`poll${pollNumber}`).innerHTML = `<div class="poll-content flex" id="pollContent${pollNumber}">
                                                  <input type="text" placeholder="Poll Text" style="outline:none; border:none;" class="poll-main-text font-poppins fw-500" id="pollInput${pollNumber}" name="poll${pollNumber}">


                                                  <p class="font-poppins fs-20 fw-500 poll-percent cursor-pointer" data-pollNum="${pollNumber}" id="pollRemover${pollNumber}" onclick="removePollInput(this)"> <i class="fa fa-times" aria-hidden="true"></i></p>
                                             </div>`;

               if (parseInt(pollNumber) < 4) {
                    const newPollNum = parseInt(pollNumber) + 1;
                    document.getElementById("Add-One-More-Poll").setAttribute('data-pollNum', newPollNum);
               } else {
                    document.getElementById("Add-One-More-Poll").removeAttribute('onclick');
               }
               document.getElementById('polling').setAttribute('value', pollNumber);
          }

          function showCommentTab(e) {
               let Identity = e;
               let showComment = document.getElementById(`show-comment-${Identity}`);
               let commentStatus = showComment.getAttribute('data-commentStatus');

               if (commentStatus == "noComments") {
                    $.post('./component/post-comments.php', {
                              postId: Identity
                         },
                         function(data, status) {
                              if (data) {
                                   $(`#show-comment-${Identity}`).html(data);
                                   $(`#show-comment-${Identity}`).toggleClass("none");
                                   showComment.setAttribute('data-commentStatus', "yesComments");
                              }
                         });
               } else if (commentStatus = "yesComments") {
                    $(`#show-comment-${Identity}`).toggleClass("none");
               }

          }

          function like(element) {
               var asset = element.id;
               var cu_down = $(`#like${asset}`).val();
               $(`#loading`).toggleClass("none");
               $.post('./actions/Like.php', {
                         asset_id: asset
                    },
                    function(data, status) {
                         $(`#loading`).toggleClass("none");
                         if (data > cu_down) {
                              $(`.icon${asset}`).toggleClass("hearted");
                         } else {
                              $(`.icon${asset}`).toggleClass("hearted");
                         }
                         // $(`#likke${asset}`).html(data);
                    });
          }

          function postLike(e) {
               var post = e.id;
               let oldHeartCount = e.getAttribute('data-oldHeartCount');
               $(`#loading`).toggleClass("none");
               $.post('./actions/postLike.php', {
                         post_id: post,
                         oldHeartCount: oldHeartCount
                    },
                    function(data, status) {
                         $(`#loading`).toggleClass("none");
                         if (data > oldHeartCount) {
                              $(`.postHeartIcon${post}`).toggleClass("fa-regular");
                              $(`.postHeartIcon${post}`).toggleClass("fa-solid");
                              $(`.postHeartIcon${post}`).toggleClass("fc-red");
                         } else {
                              $(`.postHeartIcon${post}`).toggleClass("fa-regular");
                              $(`.postHeartIcon${post}`).toggleClass("fa-solid");
                              $(`.postHeartIcon${post}`).toggleClass("fc-red");
                         }
                         $(`#postHeartCount${post}`).html(data);
                         e.setAttribute('data-oldHeartCount', data);
                    });
          }

          function commentPost(e) {
               let commentPost = e.getAttribute('data-commentPost');
               let showComment = document.getElementById(`show-comment-${commentPost}`);
               const commentValue = $(`#commentInput-${commentPost}`).val();

               if (commentValue != null && commentValue != "") {
                    $(`#loading`).toggleClass("none");

                    $.post('./actions/commentpost.php', {
                              commentSubmited: "set",
                              commentPost: commentPost,
                              commentValue: commentValue
                         },
                         function(data, status) {
                              $(`#loading`).toggleClass("none");
                              alert(data);
                              $(`#commentInput-${commentPost}`).val("");
                              showComment.setAttribute('data-commentStatus', "noComments");
                         });

               } else {
                    alert("Please write a comment before submit.");
               }
          }

          function download_count(element) {
               var asset = element.id;
               $.post('./actions/Download_Count.php', {
                         asset_id: asset
                    },
                    function(data, status) {
                         $(`#download_count_${asset}`).html(data);
                    });
          }

          function Verify_Email(email, userCode) {
               var mail = $(`#email`).val();
               var userUni = userCode;
               if (mail == null || mail == "") {

               } else {
                    $("#Verify").text("Sending Mail...");
                    $.post('./actions/Verify.php', {
                              Email: mail,
                              userId: userUni
                         },
                         function(data, status) {
                              $(".mailsenthideit").toggleClass("none");
                              $(`#mailsentmsg`).html(data);
                         });
               }
          }

          function Send_Ques(userCode) {
               var userUni = userCode;
               var user_ques = $(`#user_ques`).val();
               if (user_ques == null || user_ques == "") {

               } else {
                    $("#ques_submit").text("Sending Question...");
                    $.post('./actions/UserQuery.php', {
                              User_ques: user_ques,
                              userId: userUni
                         },
                         function(data, status) {
                              $("#ques_submit").text("Send Question");
                              alert("Your Question has been submited.");
                         });
               }
          }

          function Mode_Query(userCode) {
               var userUni = userCode;
               var uimode = document.querySelector('input[name="mode"]:checked').value;
               if (uimode == null || uimode == "") {

               } else {
                    $("#Set").text("Setting Mode...");
                    $.post('./actions/SetMode.php', {
                              Mode: uimode,
                              userId: userUni
                         },
                         function(data, status) {
                              $("#verification-mode").toggleClass("none");
                              $("#Set").text("Select");
                              document.documentElement.setAttribute('data-theme', data);
                         });
               }
          }

          // Ads click count function

          function adClicked(adsid, currentAds, userUnicode) {
               var userUniCode = userUnicode;
               var adsId = adsid;
               var currentAds = currentAds;

               if (userUniCode == null || userUniCode == "" && adsId == null || adsId == "") {

               } else {
                    $.post('./actions/adsClickCount.php', {
                         adsId: adsId,
                         userUniCode: userUniCode,
                         currentAds: currentAds
                    });
               }
          }

          function clearThisNotification(noticationElement) {
               $notificationId = noticationElement.id;
               $Id = `noti${$notificationId}`;
               $(`#${$Id}`).toggleClass("none");
               totalnoti = totalnoti - 1;
               if (totalnoti == 0) {
                    let newstyle = "top:-2px; right:0; font-size:10px;";
                    document.getElementById("havenoti").setAttribute("style", newstyle);
               }
          }

          function clearThisRegNotification(noticationElement) {
               $notificationId = noticationElement.id;
               $Id = `regnoti${$notificationId}`;
               $(`#${$Id}`).toggleClass("none");
               totalnoti = totalnoti - 1;
               if (totalnoti == 0) {
                    let newstyle = "top:-2px; right:0; font-size:10px;";
                    document.getElementById("havenoti").setAttribute("style", newstyle);
               }
          }

          function dashboardLoad(pageName, clickedFrom) {
               $(`#loading`).toggleClass("none");

               if (clickedFrom == "Side-Menu") {

                    // Side-menu Click
                    $(`#side-menu`).toggleClass("none");
                    $(`.nnmenu.active`).toggleClass("active");
                    $(`#${pageName}`).toggleClass("active");
                    $(`#Content`).load(`./pages/${pageName}.php`, function() {
                         $(`#loading`).toggleClass("none");

                         const state = {
                              'page_id': 1,
                              'user_id': 5
                         };
                         const title = '';
                         const url = `${pageName}`;

                         history.pushState(state, title, url);
                    });


               } else if (clickedFrom == "Notification") {

                    // Notification Click
                    $(`#notification-pop`).toggleClass("none");
                    $(`#Content`).load(`./pages/${pageName}.php`, function() {
                         $(`#loading`).toggleClass("none");

                         const state = {
                              'page_id': 1,
                              'user_id': 5
                         };
                         const title = '';
                         const url = `${pageName}`;

                         history.pushState(state, title, url);
                    });


               } else if (clickedFrom == "UserPopUp") {

                    // Notification Click
                    $(`#user-pop-menu`).toggleClass("none");
                    $(`#Content`).load(`./pages/${pageName}.php`, function() {
                         $(`#loading`).toggleClass("none");

                         const state = {
                              'page_id': 1,
                              'user_id': 5
                         };
                         const title = '';
                         const url = `${pageName}`;

                         history.pushState(state, title, url);
                    });


               }else if (clickedFrom == "inSidePage") {

               // Clicked from in side page
               // $(`#user-pop-menu`).toggleClass("none");
               $(`#Content`).load(`./pages/${pageName}.php`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `${pageName}`;

                    history.pushState(state, title, url);
               });


               } else {
                    console.log("No Action Defined!");
               }


          }

          function search(element) {
               // var asset = element.id;
               $(`#loading`).toggleClass("none");
               let page = element.getAttribute('data-page');
               var search_text = $(`#searchBox`).val();
               if (search_text == null || search_text == "") {

               } else {
                    if (page == "Watch-Area") {
                         $.post('./pages/Watch-Area.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    } else if (page == "Assets") {
                         $.post('./pages/Assets.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    } else if (page == "Collaboration") {
                         $.post('./pages/Collaboration.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    }else if(page == "Questions"){
                         $.post('./pages/Questions.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    }else if(page == "Assignments"){
                         $.post('./pages/Assignments.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    }else if(page == "Your-Questions"){
                         $.post('./pages/Your-Questions.php', {
                                   query: search_text
                              },
                              function(data, status) {
                                   $(`#Content`).html(data);
                                   $(`#loading`).toggleClass("none");
                              });
                    }

               }

          }

          function nicheDecider() {
               var Niche = $(`#Niche`).val();
               var MainSkill = $(`#MainSkill`).val();
               var ContentTime = $(`#ContentTime`).val();
               var ConsumeMost = $(`#ConsumeMost`).val();
               var FavChannel = $(`#FavChannel`).val();
               var SecNiche = $(`#SecNiche`).val();
               var channelName = ' <?php
                                   if (isset($_SESSION['campaignDetails'])) {
                                        echo $_SESSION['campaignDetails'][0];
                                   } else {
                                        if (isset($_SESSION['collabDetails'])) {
                                             echo $_SESSION['collabDetails'][0];
                                        } else {
                                             echo "Undefined";
                                        }
                                   }
                                   ?> ';
               if (Niche == null || Niche == "" || MainSkill == null || MainSkill == "" || ContentTime == null || ContentTime == "" || ConsumeMost == null || ConsumeMost == "" || FavChannel == null || FavChannel == "" || SecNiche == null || SecNiche == "") {

                    alert("Please fill All inputs");

               } else {

                    $(`.print-main-niche`).html(`${Niche}`);
                    $(`.print-second-niche`).html(`${SecNiche}`);
                    $(`.print-time-for-content`).html(`${ContentTime}`);
                    $(`.print-most-consumed`).html(`${ConsumeMost}`);
                    $(`.print-fav-youtuber`).html(`${FavChannel}`);
                    $(`.print-main-skill`).html(`${MainSkill}`);

                    $(`#Niche-Popup`).toggleClass("none");

                    $.post('./actions/channelDetails.php', {
                         niche: Niche,
                         secNiche: SecNiche,
                         contentTime: ContentTime,
                         consumeMost: ConsumeMost,
                         favoriteChannel: FavChannel,
                         mainSkill: MainSkill,
                         channelName: channelName,
                    });

               }

          }

          function displaythis(whichsign, whichname) {
               $(`${whichsign}${whichname}`).toggleClass("none");
          }

          function loadContent(element) {
               var page = element;
               $(`#loading`).toggleClass("none");

               $(`.nnmenu.active`).toggleClass("active");
               $(`#${page}`).toggleClass("active");

               $(`#Content`).load(`./pages/${page}.php`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `${page}`;

                    history.pushState(state, title, url);
               });
          }

          function loadCalculator(element) {
               var page = element;
               $(`#loading`).toggleClass("none");

               $(`.nnmenu.active`).toggleClass("active");
               $(`#${page}`).toggleClass("active");

               $(`#Content`).load(`./calculators/${page}.php`, function() {
                    $(`#loading`).toggleClass("none");
               });
          }

          function alertThis(messageToPrint) { 
               alert(messageToPrint);
          }

          window.addEventListener('popstate', function() {
               document.location.reload();
          });

          function triggerClick(e) {
               let id = e;
               if (id == "Upload-Post-Image") {
                    document.querySelector('#Photo-Uploader-Btn').setAttribute('class', "p-y-10 input-btn cursor-pointer");
                    document.querySelector("#PostImageViewer").setAttribute('class', "none");
                    document.getElementById('ImageInputContainer').innerHTML = `<input type="file" style="display: none;" accept="image/png, image/jpg, image/jpeg" name="postImage" id="Upload-Post-Image" onchange="displayPostImage(this)">`;
               }
               document.querySelector(`#${id}`).click();
          }

          function removePostImage() {

               document.getElementById('Upload-Post-Image').remove();
               document.querySelector("#PostImageViewer").setAttribute('class', "none");
               document.querySelector('#Photo-Uploader-Btn').setAttribute('class', "p-y-10 m-r-10 input-btn cursor-pointer");


               document.getElementById('ImageInputContainer').innerHTML = `<input type="file" style="display: none;" accept="image/png, image/jpg, image/jpeg" name="postImage" id="Upload-Post-Image" onchange="displayPostImage(this)">`;
          }

          function displayPostImage(e) {
               if (e.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                         document.querySelector('#post-image-viewer').setAttribute('src', e.target.result);
                         document.querySelector('#Photo-Uploader-Btn').setAttribute('class', "p-y-10 input-btn cursor-pointer none");
                         document.querySelector("#PostImageViewer").setAttribute('class', "pos-relative");
                         document.querySelector("#Rating-Create-Btn").setAttribute('class', "p-y-10 input-btn cursor-pointer ");
                    }
                    reader.readAsDataURL(e.files[0]);
               }
          }

          function postCreatePoll(e) {
               document.getElementById("pollInputContainer").innerHTML = `
                                        <input type="text" name="polling" value="2" id="polling" style="display: none;">
                                        <div class="pos-relative poll" style="margin-top: 60px;" id="poll1">
                                             <div class="poll-content flex">
                                                  <input type="text" placeholder="Poll Text" style="outline:none; border:none;" class="poll-main-text font-poppins fw-500" name="poll1" id="pollInput1">


                                                  <p class="font-poppins fs-20 fw-500 poll-percent cursor-pointer"> <i class="fa fa-times" aria-hidden="true"></i></p>
                                             </div>
                                        </div>
                                        <div class="pos-relative poll" style="margin-top: 5px;" id="poll2">
                                             <div class="poll-content flex">
                                                  <input type="text" placeholder="Poll Text" style="outline:none; border:none;" class="poll-main-text font-poppins fw-500" name="poll2" id="pollInput2">


                                                  <p class="font-poppins fs-20 fw-500 poll-percent cursor-pointer"> <i class="fa fa-times" aria-hidden="true"></i></p>
                                             </div>
                                        </div>`;
               $(`#${e}`).toggleClass("none");
               $("#Poll-Create-Btn").toggleClass("none");
          }

          function postRemovePoll(e) {
               document.getElementById("pollInputContainer").innerHTML = ``;
               $(`#${e}`).toggleClass("none");
               $("#Poll-Create-Btn").toggleClass("none");
               document.getElementById('Add-One-More-Poll').setAttribute('data-pollNum', "3");
               document.getElementById('Add-One-More-Poll').setAttribute('onclick', "addMorePollInput()");
          }

          function postCreateRating(e) {
               document.getElementById("ratingInputContainer").innerHTML = `<div class="fs-20 flex post-rating-show" style="justify-content: space-between; margin:0 65px 5px 25px;">
                                        <input type="text" name="rating" value="set" style="display: none;">
                                        <i class="fa-solid fa-star m-10 p-10"></i>
                                        <i class="fa-solid fa-star m-10 p-10"></i>
                                        <i class="fa-solid fa-star-half-stroke m-10 p-10"></i>
                                        <i class="fa-regular fa-star m-10 p-10"></i>
                                        <i class="fa-regular fa-star m-10 p-10"></i>
                                   </div>`;
               $(`#${e}`).toggleClass("none");
               $("#Rating-Create-Btn").toggleClass("none");
          }

          function postRemoveRating(e) {
               document.getElementById("ratingInputContainer").innerHTML = ``;
               $(`#${e}`).toggleClass("none");
               $("#Rating-Create-Btn").toggleClass("none");
          }

          var ratingClickedIndex = -1;
          var ratingClickedPost = -1;

          function ratingClicked(e) {
               ratingClickedIndex = parseInt(e.getAttribute('data-star'));
               ratingClickedPost = parseInt(e.getAttribute('data-postStar'));

               $.post('./actions/rateIt.php', {
                         rateThis: "set",
                         post: ratingClickedPost,
                         star: ratingClickedIndex
                    },
                    function(data, status) {
                         $(`#ratingData${ratingClickedPost}`).html(data);
                    });
          }

          function ratingMouseOver(e) {
               let starNum = e.getAttribute('data-star');
               let post = e.getAttribute('data-postStar');

               let i = 1;
               while (i <= starNum) {
                    let newClass = "fa-solid fa-star m-10 p-10 ratingStar";
                    document.getElementById(`ratingStar${post}${i}`).setAttribute('class', newClass);
                    i++;
               }

          }

          function ratingMouseOut(e) {
               let starNum = 5;
               let post = e.getAttribute('data-postStar');
               let alreadyVotedStar = document.getElementById(`rating${post}`).getAttribute('data-rating');
               var i;

               if (ratingClickedIndex != -1) {
                    if (ratingClickedPost != -1 && ratingClickedPost == parseInt(post)) {
                         document.getElementById(`rating${post}`).setAttribute('data-rating', ratingClickedIndex);
                         i = parseInt(ratingClickedIndex) + 1;
                         ratingClickedIndex = -1, ratingClickedPost = -1;
                    } else {
                         if (alreadyVotedStar > 0) {
                              i = parseInt(alreadyVotedStar) + 1;
                         } else {
                              i = 1;
                         }
                    }
               } else {
                    if (alreadyVotedStar > 0) {
                         i = parseInt(alreadyVotedStar) + 1;
                    } else {
                         i = 1;
                    }
               }

               while (i <= starNum) {
                    let newClass = "fa-regular fa-star m-10 p-10 ratingStar";
                    document.getElementById(`ratingStar${post}${i}`).setAttribute('class', newClass);
                    i++;
               }
          }



          let notTopNewPost = "False";

          /* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
          var prevScrollpos = window.pageYOffset;
          window.onscroll = function() {
               var currentScrollPos = window.pageYOffset;
               if (prevScrollpos > currentScrollPos) {
                    document.getElementById("header").style.top = "0";
               } else {
                    document.getElementById("header").style.top = "-85px";

                    if (notTopNewPost == "True") {
                         $("#Write-post-Top").html("");
                         $("#notTop").toggleClass('none');
                         notTopNewPost = "False";
                    }
               }
               prevScrollpos = currentScrollPos;
          }



          // for update notification 

          $("#notificationIcon").on('click', function() {

               $.post('./actions/clearUpdateNotification.php', {
                    clearUpdateNotification: "set"
               }, function(data) {
                    if (data > 0) {
                         if (totalnoti == 0) {
                              let newstyle = "top:-2px; right:0; font-size:10px;";
                              document.getElementById("havenoti").setAttribute("style", newstyle);
                         }
                    }
               });
          });
          var obj;

          function notificationLoad(e) {

               if (e.includes('feedbacks-')) {
                    let videoId = e.replace("feedbacks-", "");
                    $(`#loading`).toggleClass("none");
                    // for feedbacks
                    $(`#Content`).load(`./pages/Feedbacks.php?videoId=${videoId}`, function() {
                         $(`#loading`).toggleClass("none");

                         const state = {
                              'page_id': 1,
                              'user_id': 5
                         };
                         const title = '';
                         const url = `feedbacks-${videoId}`;

                         history.pushState(state, title, url);
                    });

               } else if (e.includes('Profile-')) {
                    // for post

                    let postId = e.replace("Profile-", "");
                    $(`#loading`).toggleClass("none");

                    function findPosition(j) {
                         obj = document.getElementById(j);
                         var currenttop = 0;

                         if (obj) {
                              if (obj.offsetParent) {
                                   do {
                                        currenttop += obj.offsetTop;
                                   } while ((obj = obj.offsetParent));
                                   return [currenttop];
                              }
                         } else {
                              currenttop = document.body.offsetHeight + 400;
                              return [currenttop];

                         }

                    }

                    function bottomScroll() {
                         let bot = document.body.offsetHeight + 400;
                         window.scrollTo(0, bot);
                    }

                    function scrolldiv() {
                         window.scrollTo(0, findPosition(postId));
                    }

                    $(`#Content`).load(`./pages/Profile.php`, function() {

                         let checkObj = document.getElementById(postId);

                         if (checkObj) {
                              scrolldiv();
                         } else {
                              bottomScroll();

                              setTimeout(function() {
                                   scrolldiv();
                              }, 2000);
                         }

                         $(`#loading`).toggleClass("none");

                         const state = {
                              'page_id': 1,
                              'user_id': 5
                         };
                         const title = '';
                         const url = `Profile`;

                         history.pushState(state, title, url);
                    });
               }


          }

          function showAnswer(i){
               $(`#answer${i}`).toggleClass("none");
          }
     </script>

</body>

</html>