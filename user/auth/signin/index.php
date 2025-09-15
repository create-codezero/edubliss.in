<?php
session_start();
require_once '../../../connect/connectDb/config.php';
if (!empty($_SESSION['userFullName'])) {
     header('location: ../../../dashboard/Home');
}
if (!isset($_SESSION['mode'])) {
     $_SESSION['mode'] = "light";
}

?>



<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['mode']; ?>">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign In -- EduBliss</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
     <link rel="stylesheet" href="../../../css/Sass/<?php echo $cssfile; ?>" />
     <link rel="icon" href="../../../media/Icons/logo.png">
</head>

<body>
     <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="../../../" class="m-l-10 img-fluid flex e-c" >
                         <img src="../../../media/Icons/full_logo.png" style="height:45px;" alt="STUMITRA" class="yastiwari">
                    </a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../signup/">
                         Sign Up
                    </a>
               </div>
          </div>
     </div>
     <!-- signin TAB -->
     <div class="flex w-100per e-c" id="signIn">
          <div class="flex m-t-10 mainBarConatiner" style="max-width:1600px; width:95%;">
               <div class="side-bar" style="width: 40%;">
                    <img src="../../../media/Images/newFormSideGraphic.png" alt="" class="img-fluid" style="border-radius:15px 0 0 15px; height: 100%;">
               </div>
               <div class="flex e-c main-bar">
                    <div class="form-box">
                         <div class="main-box">
                              <form action="./SignIn.php" method="POST">
                                   <p class="fs-40 tx-center nnboxtitle">Sign In</p>

                                   <!-- Printing Errors -->
                                   <p style="color: red;" class="m-y-10 tx-center"><?php if (isset($_SESSION['wrong'])) {
                                                                                          echo $_SESSION['wrong'];
                                                                                     } ?></p>

                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                                   <div class="input">
                                        <input type="text" name="Email" id="email" placeholder="E-mail" required>
                                   </div>

                                   <p class="fs-15 fw-500 nnpassword" style="margin-top: 20px; margin-left: 2px;">Password</p>
                                   <div class="input m-b-20 nnpassword">
                                        <input type="Password" name="Password" id="password" placeholder="Password" class="nnpassword" required>
                                        <i class="fa fa-eye cursor-pointer p-10 fs-20 nnpassword" aria-hidden="true" onclick="showHidePassword(this)" id="signInEye"></i>
                                   </div>

                                   <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignIn" id="signin">Sign In</button>

                                   <p class="tx-center m-y-10"> No account? <a href="../signup/" class="fc-secondary">Create one</a> </p>
                                   <p class="tx-center m-y-10"><a href="javascript:void(0)" class="fc-secondary">Recover Account</a> | <a href="javascript:void(0)" class="fc-secondary nnforgotpassword" onclick="forgotPassword()">Forgot Password?</a> </p>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Forgot Password Tab -->
     <div class="flex e-c h-75vh m-y-50 none" id="ForgotPassword">
          <div class="form-box">
               <div class="main-box" id="forgetpassform">
                    <p class="fs-30 tx-center nnboxtitle">Find your Account</p>
                    <p class="m-y-10 tx-center fc-primary">Please enter your email to search your account.</p>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                    <div class="input">
                         <input type="text" name="Email" id="searchEmail" placeholder="E-mail" required>
                    </div>

                    <button class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignIn" id="search" onclick="sendpasswordreset()">Search</button>

                    <p class="tx-center m-y-10"> No account? <a href="../signup/" class="fc-secondary">Create one</a> </p>
                    <p class="tx-center m-y-10"><a href="javascript:void(0)" class="fc-secondary">Recover Account</a> | <a href="javascript:void(0)" class="fc-secondary nnforgotpassword" onclick="forgotPassword()">Sign In</a> </p>
               </div>
          </div>
     </div>

     <!-- Continue to previous Identity -->

     <div class="sector z-2 pos-fixed flex e-c flex-d-column h-100vh <?php
                                                                      if (!isset($_COOKIE['userEmail']) && !isset($_COOKIE['userPassword'])) {
                                                                           echo "none";
                                                                      }
                                                                      ?>" id="verification-pop" style="top: 0; left:0; background-color: var(--shadow-clr);">


          <div class="form-box  bg-clr-1">
               <div class="main-box">
                    <div class="block tx-right w-100per" onclick="clickOn('verification-pop')">
                         <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                         <hr class="bg-dark-blue">
                    </div>
                    <form class="m-t-20" method="POST" action="./SignIn.php">
                         <p class="fs-20 tx-center" id="mailsentmsg">Sign In Confirmation</p>

                         <p class="fs-15 tx-center m-t-10 mailsenthideit"> We have found a previous sign in details do you want to continue with it. </p>

                         <button class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" type="submit" name="takemein">Yes</button>
                    </form>
               </div>
          </div>

     </div>

     <!-- Script  -->
     <script src="../../../js/actions.js"></script>
     <script>
          function forgotPassword() {

               $("#ForgotPassword").toggleClass("none");
               $("#signIn").toggleClass("none");

          }

          function sendpasswordreset() {
               var search_mail = $(`#searchEmail`).val();
               if (search_mail == null || search_mail == "") {

               } else {
                    $("#search").text("Searching...");

                    $.post('../../../dashboard/actions/Forget.php', {
                              email: search_mail
                         },
                         function(data, status) {
                              $(`#forgetpassform`).html(data);
                         });
               }

          }
     </script>

</body>

</html>