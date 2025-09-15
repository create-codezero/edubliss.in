<?php
session_start();
require_once '../connect/connectDb/config.php';

if (!isset($_SESSION['mode'])) {
     date_default_timezone_set("Asia/Kolkata");
     $hour = date('H');
     if ($hour <= 18 && $hour >= 6) {
          $_SESSION['mode'] = "light";
     } else {
          $_SESSION['mode'] = "dark";
     }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['mode']; ?>">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Contact Us - Stumitra</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
     <link rel=" stylesheet" href="../css/Sass/<?php echo $cssfile; ?>" />

     <!-- all new meta tags  -->
     <meta name="description" content="Welcome to STUMITRA, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="keywords" content="Welcome to STUMITRA, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="author" content="Yas Tiwari">


     <meta property="og:url" content="http://www.stumitra.rf.gd/">
     <meta property="og:title" content="Welcome to STUMITRA, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="keywords" content="Welcome to STUMITRA, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta property=" og:type" content="article">
     <meta property="og:site_name" content="Welcome to STUMITRA, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="robots" content="index,follow">
     <!-- all new meta tags  -->
     <link rel="icon" href="../media/Images/LOGO_CIRCLE.png">
</head>

<body>
     <div class="header-box">
          <div class="header">
               <div class="branding">
               <a href="#"><img src="../media/Icons/logo.png" alt="Logo" class="logo" style="max-height:45px;"></a>
               <a href="#" class="m-l-10 img-fluid"><img src="../media/Icons/stumitra.png" alt="Stumitra" class="yastiwari" style="max-height:35px;"></a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="../user/auth/signin/" title="Sign In">
                         Sign In
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
                         <form action="./contact.php" method="POST">
                              <p class="fs-40 tx-center">Contact Us</p>

                              <!-- Inputs -->
                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Full Name</p>
                              <div class="input">
                                   <input type="text" name="Name" id="Name" placeholder="Full Name" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                              <div class="input">
                                   <input type="Email" name="Email" id="email" placeholder="E-mail" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Phone</p>
                              <div class="input">
                                   <input type="number" name="PhoneNum" id="phoneNum" placeholder="Phone" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Message</p>
                              <div class="input">
                                   <textarea style="line-height:20px; margin-top:5px; border-radius: 0px;" name="Message" id="message" rows="5"></textarea>
                              </div>




                              <p class="fs-10 tx-center m-t-10"> Reply will be sended to your mail. </p>


                              <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="contact_submit">Send</button>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</body>

</html>