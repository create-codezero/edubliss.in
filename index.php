<?php
session_start();
require_once './connect/connectDb/config.php';


if (isset($_GET['redirectto'])) {

     $_SESSION['pathishere'] = $_GET['redirectto'];
}

if (isset($_GET['dpage'])) {

     $_SESSION['path'] = $_GET['dpage'];
}

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
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
     <link rel=" stylesheet" href="./css/Sass/<?php echo $cssfile; ?>" />
     <title>Conquer your Grades with EDUBLISS</title>
     <!-- all new meta tags  -->
     <meta name="description" content="Welcome to EDUBLISS, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="keywords" content="Welcome to EDUBLISS, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="author" content="Yas Tiwari">


     <meta property="og:url" content="http://www.stumitra.rf.gd/">
     <meta property="og:title" content="Welcome to EDUBLISS, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="keywords" content="Welcome to EDUBLISS, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta property=" og:type" content="article">
     <meta property="og:site_name" content="Welcome to EDUBLISS, your ultimate destination for free handwritten digital notes, mind maps, formula sheets, and more. We are dedicated to enhancing your learning experience by offering comprehensive resources designed to help you excel academically. Whether you're preparing for exams or seeking clarity on challenging topics, our curated collection of study materials and solutions to important questions ensures you have the tools you need to succeed. Join the Best Community of students, Now!., iitm bs ds, iitm bs in data science">
     <meta name="robots" content="index,follow">
     <!-- all new meta tags  -->
     <link rel="icon" href="./media/Icons/logo.png">
</head>

<body>
     <div class="header-box">
          <div class="header">
               <div class="branding" >
                    <a href="#"><img src="./media/Icons/logo.png" style="height:45px;" alt="Logo" class="logo"></a>
                    <a href="#" class="m-l-10 img-fluid">
                         <img src="./media/Icons/edubliss.png" style="height:35px;" alt="EduBliss"  class="edubliss">
                    </a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="./user/auth/signin/" title="Sign In">
                         Sign In
                    </a>
               </div>
          </div>
     </div>
     <!-- Landing section -->

     <div class="sector grid h-100vh tab-h-100per tab-p-y-40 mob-h-100per grid-column-2 tab-grid-column-1 mob-p-y-80" id="landing">

          <div class="flex e-c mob-m-b-50">
               <div class="m-x-100 mob-m-x-30 tab-tx-center">
                    <p class="heading fc-primary fw-600">Refining <span class="fc-secondary">Excellence</span><br> to Achieve a <span class="fc-secondary">Legendary Legacy</span>.</p>
                    <!-- <p class="sub-heading fc-primary">yas tiwrai - how to grow on youtube</p> -->
                    <br>
                    <p class="normal-tx fc-primary fs-15">Welcome to <span class="fc-secondary">EduBliss</span>, the ultimate. Our platform is meticulously designed to empower learners with top-tier resources and support, ensuring academic excellence at every level—from Foundation to Diploma and beyond. Dive into our comprehensive collection of solution PDFs for graded and practice assignments, previous exam questions, and mock test solutions. Benefit from <span class="fc-secondary">handwritten notes by top students, live session slides, and essential book PDFs</span>. Our <span class="fc-secondary">interactive social media page</span> fosters a vibrant community where students can ask questions, share insights, and collaborate. Additionally, our specialized calculators simplify complex statistical and machine learning computations, saving you valuable time. As we expand, expect even more resources tailored for other IITs and competitive exams like JEE and NEET. At <span class="fc-secondary">EduBliss</span>, we're dedicated to making your educational journey seamless, engaging, and successful.</p>
                    <div class="tab-m-y-10"></div>
                    <a class="btn btn-gra-purple tab-m-auto m-y-20" href="./lookdashboard" title="Sign Up">Take A Look</a>
               </div>
          </div>
          <div class="flex e-c m-x-100 mob-m-x-50 tab-m-x-100 tab-p-y-20">

               <img src="./media/Illustrations/home_main_illu.png" alt="Yas tiwari home page illustration" class="img-fluid">

          </div>

     </div>

     <!-- <div class="w-75per bg-clr-4 m-auto m-t-30" style="height: 2px;"></div> -->


     <!-- Our Work -->

     <div class="flex flex-d-column e-c w-100per m-b-30">

          <div class="tx-center m-t-10 text-container">
               <p class="heading"> Free Works </p>
               <p class="fs-20">These are some absolutely free works we have done for Students to help them in their Growth.</p>
          </div>


          <div class="flex w-100per e-c m-t-20 font-poppins" style="flex-wrap: wrap;" id="service-container">

               <div class="flex m-10 e-c service-card">
                    <a href="./user/auth/signin/">
                         <div class="tx-center m-40">
                              <img src="./media/svg/undraw_books_re_8gea.svg" alt="Social Media Expert" class="service-img">

                              <p class="fs-30 m-t-30">Free Pdf Notes</p>

                              <p class="m-t-10" style="font-size: 14px;">
                                   We are providing pdf notes, midmaps, formula notes, etc for absolutely free to help students. Our every pdf is well checked and designed in a so that student don't lose their interest in studing them. Checkout now by Signing Up.
                              </p>
                         </div>
                    </a>
               </div>

               <div class="flex m-10 e-c service-card">
                    <a href="./user/auth/signin/">
                         <div class="tx-center m-40">
                              <img src="./media/svg/undraw_questions_re_1fy7.svg" alt="Marketing Expert" class="service-img">

                              <p class="fs-30 m-t-30">Free Question Solution</p>

                              <p class="m-t-10" style="font-size: 14px;">
                                   We know every student face problem during solving questions, we have providing handwritten as well as normal text solution for evrey important question.Student can upload their question if he/she is facing problem in any question and admin will answer it in few hours.
                              </p>
                         </div>
                    </a>
               </div>

               <div class="flex m-10 e-c service-card">
                    <a href="./user/auth/signin/">
                         <div class="tx-center m-40">
                              <img src="./media/svg/undraw_community_re_cyrm.svg" alt="Social Media Expert" class="service-img">

                              <p class="fs-30 m-t-30">Free Student Community</p>

                              <p class="m-t-10" style="font-size: 14px;">
                                   We have built a student community where student student can post what ever they want and interact with eachother by posting text post, polls, rating post, photos. So, What are you waiting for sign up now and start using.
                              </p>
                         </div>
                    </a>
               </div>

          </div>
     </div>
     

     <div class="footer bg-clr-4">
          <div class="e-c footer">

               <div class="grid grid-column-4 m-x-30 tab-grid-column-2 mob-grid-column-1">


                    <div class="mob-m-10">
                         <a href="javascript:void(0)" download><img src="./media/Icons/footer_logo.png" class="bg-clr-1" alt="Logo" style="max-height:70px;"></a>
                    </div>

                    <div class=" mob-m-10">
                         <ul id="footer-links">
                              <p class="sub-heading fc-primary">Links</p>
                              <hr class="m-y-10 w-75per">
                              <li><a href="./info/our-team/">Our Team</a></li>
                              <li><a href="./legal/terms-and-conditions/">Terms & Conditions</a></li>
                              <li><a href="./privacy-policy/">Privacy Policy</a></li>
                              <li><a href="./contact-us">Contact Us</a></li>
                              <li><a href="./bug/">Report Bug</a></li>
                         </ul>
                    </div>

                    <div class=" mob-m-10 tab-m-y-20">
                         <p class="sub-heading fc-primary">Latest Updates</p>
                         <hr class="m-y-10 w-75per">
                         <div class="m-r-10">
                              <p class="sub-heading fc-secondary"><i class="fab fa-youtube" aria-hidden="true"></i> Youtube </p>
                              <p class="fc-dark-white m-y-10 font-poppins">Subscribe Our Youtube Channel For More Educational Videos.</p>
                         </div>
                         <div class="m-r-10">
                              <p class="sub-heading fc-secondary"> <i class="fab fa-facebook" aria-hidden="true"> </i> Facebook Page</p>
                              <p class="fc-dark-white m-y-10 font-poppins">Follow Our Facebook Page for More Updates .</p>
                         </div>
                    </div>

                    <div class=" mob-m-10 tab-m-y-20">
                         <p class="sub-heading fc-primary">Follow Us</p>
                         <hr class="m-y-10 w-75per">
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
                                   <a href="website.edubliss@gmail.com" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                              </div>

                              <div class="bg-footer-icon m-l-10">
                                   <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                              </div>
                         </div>

                    </div>

               </div>
          </div>
     </div>
     <div class="sector flex e-c bg-footer-copyright p-y-10">
          <p class="font-poppins fc-primary">&copy; · <a href="#" class="fc-secondary"> EDUBLISS </a> · All Rights Reserved!</p>
     </div>

</body>

</html>