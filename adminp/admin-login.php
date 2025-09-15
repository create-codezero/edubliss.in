<?php
session_start();
require_once '../connect/connectDb/config.php';

if (isset($_SESSION['admin-panel'])) {
     header('location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Panel Log In</title>
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>">
     <link rel="icon" href="../media/images/l_c.png">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
     <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="../"><img src="../media/Icons/full_logo.png" alt="Logo" style="max-height:45px;" class="logo m-l-10"></a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../user/auth/signin/" title="Sign In">
                         User
                    </a>
               </div>
          </div>
     </div>

     <div class="flex w-100per" id="signIn">
          <div class="side-bar" style="width: 40%;">
               <img src="../media/Images/img_sign_1.png" alt="" class="img-fluid" style="height: 100%;">
          </div>
          <div class="flex e-c main-bar">
               <div class="form-box">
                    <div class="main-box">
                         <form action="./actions/adminAuth.php" method="POST">
                              <p class="fs-40 tx-center nnboxtitle">Admin Log In</p>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Username</p>
                              <div class="input">
                                   <input type="text" name="Email" id="email" placeholder="Username" required>
                              </div>

                              <p class="fs-15 fw-500 nnpassword" style="margin-top: 20px; margin-left: 2px;">Password</p>
                              <div class="input m-b-20 nnpassword">
                                   <input type="Password" name="Password" id="password" placeholder="Password" class="nnpassword" required>
                                   <i class="fa fa-eye cursor-pointer p-10 fs-20 nnpassword" aria-hidden="true" onclick="showHidePassword(this)" id="signInEye"></i>
                              </div>

                              <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignIn" id="signin">Sign In</button>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <script src="../js/actions.js"></script>
</body>

</html>