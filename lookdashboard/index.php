<?php
session_start();
require_once '../connect/connectDb/config.php';
require_once "../connect/function/timeago.php";

if (isset($_SESSION['userFullName'])) {
     header('location: ../dashboard');
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
$haveNotification = "False";


$_SESSION['visited'] = array();

date_default_timezone_set("Asia/Kolkata");
$hour = date('H');
if ($hour <= 18 && $hour >= 6) {
     $_SESSION['mode'] = "light";
} else {
     $_SESSION['mode'] = "dark";
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['mode']; ?>">

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
                    <a href="javascript:void(0)" id="notificationIcon" onclick="alertThis('Sign up to use this Feature.')">
                         <i class="fa fa-bell fc-secondary
fc-secondary fs-20 pos-relative hover-fc-primary" aria-hidden="true" style="padding: 2px 5px;"><samp style="top:-2px; right:0; font-size:10px; background-color: var(--clr-7);" class="pos-absolute font-poppins fc-primary fw-400" id="havenoti"></samp></i>
                    </a>
                    <a href="../user/auth/signup/" class="m-l-20 fw-500 font-poppins pos-relative flex e-c" style="background-color: var(--primary); border-radius: 100px; color: var(--clr-1); height:40px;">
                         <p class="m-20">Sign Up</p>
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
                    <li><a href="../user/auth/signup/" class="fc-dark-blue font-poppins fs-20"><i class="fas fa-user"></i> Sign Up</a></li>
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
               alert("Sign up to use this Feature.");
          }

          function votePoll(e) {
               alert("Sign up to use this Feature.");
          }

          function removePollInput(e) {
               alert("Sign up to use this Feature.");
          }

          function addMorePollInput() {
               alert("Sign up to use this Feature.");
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
               alert("Sign up to use this Feature.");
          }

          function postLike(e) {
               alert("Sign up to use this Feature.");
          }

          function commentPost(e) {
               alert("Sign up to use this Feature.");
          }

          function download_count(element) {
               alert("Sign up to use this Feature.");
          }

          function Verify_Email(email, userCode) {
               alert("Sign up to use this Feature.");
          }

          function Send_Ques(userCode) {
               alert("Sign up to use this Feature.");
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

          function clearThisNotification(noticationElement) {
               alert("Sign up to use this Feature.");
          }

          function clearThisRegNotification(noticationElement) {
               alert("Sign up to use this Feature.");
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
               alert("Sign up to use this Feature.");

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
               alert("Sign up to use this Feature.");
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
               alert("Sign up to use this Feature.");
          });
          var obj;

          function notificationLoad(e) {

               alert("Sign up to use this Feature.");


          }

          function showAnswer(i){
               alert("Sign up to use this Feature.");
          }
     </script>

</body>

</html>