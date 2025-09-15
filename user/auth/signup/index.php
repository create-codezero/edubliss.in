<?php
session_start();
require_once '../../../connect/connectDb/config.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['mode']; ?>">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign Up -- EduBliss</title>
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
                    <a class="btn btn-primary" href="../signin/">
                         Sign In
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
                              <form action="./SignUp.php" method="POST">
                                   <p class="fs-40 tx-center">Sign Up</p>

                                   <!-- Printing Errors -->
                                   <p style="color: red;" class="m-y-10 tx-center"><?php if (isset($_SESSION['user_exist'])) {
                                                                                          echo $_SESSION['user_exist'];
                                                                                     } ?></p>

                                   <!-- Inputs -->
                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Full Name</p>
                                   <div class="input">
                                        <input type="text" name="FullName" id="fullName" placeholder="Full Name" required>
                                   </div>

                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                                   <div class="input">
                                        <input type="Email" name="Email" id="email" placeholder="E-mail" required>
                                   </div>

                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Phone</p>
                                   <div class="input">
                                   <input type="number" name="Phone" maxlength="10" id="phoneNum" placeholder="Phone" required>
                                   </div>

                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Password</p>
                                   <div class="input m-b-20">
                                        <input type="Password" name="Password" id="password" placeholder="Password" required>
                                        <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="signInEye"></i>
                                   </div>

                                   <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Re-Enter Password</p>
                                   <div class="input m-b-20">
                                        <input type="Password" name="re-Password" id="re-password" placeholder="Password" required>
                                        <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="re-signInEye"></i>
                                   </div>
                                   <p class="fs-10 tx-center m-t-10"> Click “Sign Up” to agree to <a href="javascript:void(0)" onclick="notAvailable()" class="fc-secondary">EduBliss’s Terms of Service</a> and acknowledge that <a href="javascript:void(0)" onclick="notAvailable()" class="fc-secondary">EduBliss’s Privacy Policy</a> applies to you. </p>


                                   <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignUp">Sign Up</button>

                                   <p class="tx-center"> Already have an account? <a href="../signin/" class="fc-secondary">Sign in</a> </p>
                              </form>
                         </div>
                    </div>
               </div>
          </div>

     </div>


     <!-- Script  -->
     <script src="../../../js/actions.js"></script>
</body>

</html>