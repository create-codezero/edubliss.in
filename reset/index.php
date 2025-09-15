<?php
session_start();
require_once '../connect/connectDb/config.php';
$haveDetail = "False";



if (isset($_GET['userEmail']) && isset($_GET['uniCode']) && isset($_GET['wCode'])) {
     $haveDetail = "True";
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Reset Password -- EduBliss</title>
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
     <link rel="icon" href="../media/Icons/logo.png">
</head>

<body>

     <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="/"><img src="../media/Icons/logo.png" style="height:45px;" alt="Logo" class="logo"></a>
                    <a href="/" class="m-l-10 img-fluid">
                         <img src="../media/Icons/edubliss.png" style="height:35px;" alt="EduBliss"  class="edubliss">
                    </a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-primary" href="../user/auth/signin/">
                         Sign In
                    </a>
               </div>
          </div>
     </div>
     <?php
     if (isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['re-Password'])) {

          if ($_POST['Password'] == $_POST['re-Password']) {
               $email = $_POST['Email'];
               $password = md5($_POST['Password']);


               $q = "UPDATE `78000_user` SET `userPassword` = '$password' WHERE `userEmail` = '$email'";

               $fire_q = mysqli_query($link, $q);

               $query = "SELECT * FROM `78000_user` WHERE userEmail='$email' AND userPassword='$password'";

               $results = mysqli_query($link, $query);

               if (mysqli_num_rows($results) == 1) {
                    while ($a = mysqli_fetch_assoc($results)) {
                         $userFullName = $a['userFullName'];
                         $userUniqueCode = $a['userUniqueCode'];
                         $userDetails = array($a['userId'], $a['userFullName'], $a['userEmail'], $a['userPlan'], $a['userVerificationCode'], $a['userUniqueCode'], $a['userVerified']);
                    }

                    // saving Data into Session
                    $_SESSION['userDetails'] = $userDetails;
                    $_SESSION['userFullName'] = $userFullName;
                    $_SESSION['userUniqueCode'] = $userUniqueCode;



                    //Redirecting User to Dashborad
                    if (!isset($_SESSION['pathishere'])) {
                         header('location: ../dashboard/');
                    } else {
                         $path = $_SESSION['pathishere'];
                         header('location: ' . $path . '');
                    }
               } else {

                    // If no user Found

                    $_SESSION['error_redirect'] = "Redirect from reset Page";
                    echo $email . $password;
                    echo $q;
                    echo $query;
                    // header('location: ../');
               }
          } else {
               echo '
          <div class="flex e-c h-75vh m-y-50" id="signIn">
               <div class="form-box">
                    <div class="main-box">
                         <form action="./" method="POST">
                              <p class="fs-40 tx-center nnboxtitle">Reset Password</p>

                              <p style="color: red;" class="m-y-10 tx-center">New Password and Confirm Password are not Matching.</p>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                              <div class="input">
                                   <input type="text" name="Email" id="email" placeholder="E-mail" value="' . $_POST['Email'] . '" disabled required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">New Password</p>
                              <div class="input m-b-20">
                                   <input type="Password" name="Password" id="password" placeholder="Password" value="' . $_POST['Password'] . '" required>
                                   <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="signInEye"></i>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Confirm Password</p>
                              <div class="input m-b-20">
                                   <input type="Password" name="re-Password" id="re-password" placeholder="Password" value="' . $_POST['re-Password'] . '" required>
                                   <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="re-signInEye"></i>
                              </div>

                              <button type="submit" class="btn btn-dark-blue cursor-pointer" style="margin: 25px auto 5px;">Reset</button>

                         </form>
                    </div>
               </div>
          </div>
          ';
          }
     }
     if ($haveDetail == "True") {
          echo '
          <div class="flex e-c h-75vh m-y-50" id="signIn">
               <div class="form-box">
                    <div class="main-box">
                         <form action="./" method="POST">
                              <p class="fs-40 tx-center nnboxtitle">Reset Password</p>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                              <div class="input">
                                   <input type="text" name="Email" id="email" placeholder="E-mail" value="' . $_GET['userEmail'] . '" disabled required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">New Password</p>
                              <div class="input m-b-20">
                                   <input type="Password" name="Password" id="password" placeholder="Password" required>
                                   <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="signInEye"></i>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Confirm Password</p>
                              <div class="input m-b-20">
                                   <input type="Password" name="re-Password" id="re-password" placeholder="Password" required>
                                   <i class="fa fa-eye cursor-pointer p-10 fs-20" aria-hidden="true" onclick="showHidePassword(this)" id="re-signInEye"></i>
                              </div>

                              <button type="submit" class="btn btn-dark-blue cursor-pointer" style="margin: 25px auto 5px;">Reset</button>

                         </form>
                    </div>
               </div>
          </div>
          ';
     }
     ?>
     <script src="../js/actions.js"></script>

</body>

</html>