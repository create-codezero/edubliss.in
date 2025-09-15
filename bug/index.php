<?php
session_start();
require_once '../connect/connectDb/config.php';
if (!isset($_SESSION['userFullName'])) {
     $_SESSION['pathishere'] = "../../../bug/";
     header('location: ../user/auth/signin/');
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['userDetails'][7]; ?>">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Report Bug -- Yas Tiwari</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>" />
     <link rel="icon" href="../media/Icons/logo.png">
</head>

<body>
     <div class="header-box">
          <div class="header">
               <div class="branding">
                    <a href="/"><img src="../media/Icons/logo.png" alt="Logo" class="logo"></a>
                    <a href="/" class="m-l-10 img-fluid">
                         <img src="../media/Icons/yastiwari.png" alt="Yas Tiwari" class="yastiwari">
                    </a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue fc-white" href="../user/auth/signin/">
                         Sign In
                    </a>
               </div>
          </div>
     </div>
     <!-- signin TAB -->
     <div class="flex e-c h-100per m-y-50">
          <div class="form-box">
               <div class="main-box">
                    <form>
                         <p class="fs-40 tx-center nntitle">Report Bug</p>

                         <!-- Printing Errors -->

                         <!-- Inputs -->
                         <p class="fs-15 fw-500 nninputs" style="margin-top: 20px; margin-left: 2px;">Bug Title</p>
                         <div class="input nninputs">
                              <input type="text" class="nninputs" name="bugTitle" id="bugTitle" placeholder="Bug Title" required>
                         </div>

                         <p class="fs-15 fw-500 nninputs" style="margin-top: 20px; margin-left: 2px;">Explain Bug</p>
                         <div class="input nninputs">
                              <input type="text" class="nninputs" name="bugDescription" id="bugDescription" placeholder="Explain Bug" required>
                         </div>

                         <p class="fs-15 fw-500 nninputs" style="margin-top: 20px; margin-left: 2px;">Bug Page Link</p>
                         <div class="input nninputs">
                              <input type="text" class="nninputs" name="bugPage" id="bugPage" placeholder="Bug Page Link" required>
                         </div>

                         <p class="fs-15 fw-500 nninputs" style="margin-top: 20px; margin-left: 2px;">Your Instagram</p>
                         <div class="input nninputs">
                              <input type="text" class="nninputs" name="reporterInstagram" id="reporterInstagram" placeholder="Your Instagram" required>
                         </div>

                         <p class="fs-10 tx-center m-t-10 nninputs"> We are Thankful If you report a Bug. </p>


                         <a href="javascript:void(0)" class="btn btn-gra-purple fc-white cursor-pointer" style="margin: 25px auto 5px;" " onclick=" reportBug()" id="reportbtn">Report</a>

                         <p class=" tx-center"> By Mistake here? <a href="../" class="fc-secondary">Home</a> </p>
                    </form>
               </div>
          </div>
     </div>


     <!-- Script  -->
     <script src="../js/actions.js"></script>
     <script>
          function reportBug() {
               var bugTitle = $(`#bugTitle`).val();
               var bugDescription = $(`#bugDescription`).val();
               var bugPage = $(`#bugPage`).val();
               var reporterInstagram = $(`#reporterInstagram`).val();

               if (bugTitle == null || bugTitle == "") {

               } else {
                    $.post('./report.php', {
                              bugTitle: bugTitle,
                              bugDescription: bugDescription,
                              bugPage: bugPage,
                              reporterInstagram: reporterInstagram
                         },
                         function(data, status) {
                              $(".nninputs").toggleClass("none");
                              $("#reportbtn").text("Home")
                              document.getElementById("reportbtn").setAttribute("href", "../");
                              document.getElementById("reportbtn").setAttribute("onclick", "");
                              $(`.nntitle`).html(data);
                         });
               }

          }
     </script>
</body>

</html>