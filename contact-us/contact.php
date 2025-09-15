<?php
session_start();
require_once '../connect/connectDb/config.php';

if (isset($_POST['contact_submit'])) {
     $Name = mysqli_real_escape_string($link, $_POST['Name']);
     $Email = mysqli_real_escape_string($link, $_POST['Email']);
     $PhoneNum = mysqli_real_escape_string($link, $_POST['PhoneNum']);
     $Message = mysqli_real_escape_string($link, $_POST['Message']);

     //time and date
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y/m/d");
     $time = date("h:i:sa");

     $dateTime = $time . " " . $date;

     $query = "INSERT INTO `78000_contact_us`(`name`, `email`, `phoneNum`, `message`, `date`) VALUES ('$Name','$Email','$PhoneNum','$Message','$dateTime')";

     $firequery = mysqli_query($link, $query);

     if ($firequery) {
?>
          <!DOCTYPE html>
          <html lang="en" data-theme="<?php if (isset($_SESSION['userDetails'])) {
                                             echo $_SESSION['userDetails'][7];
                                        } else {
                                             echo "light";
                                        }  ?>">

          <head>
               <meta charset="UTF-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title>Thanks for Contacting Us</title>

               <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
               <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
               <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>" />
               <link rel="icon" href="../media/Icons/logo.png">
          </head>

          <body>

               <div class="flex e-c h-100vh">

                    <div class="tx-center p-y-20" style="max-width:600px; width:90%;">
                         <h1 class="m-y-30">Thanks for Contacting Us.</h1>
                         <h4 class="m-b-20">Your Message has been sent. We will contact you through email or Phone.</h4>
                         <a class="btn btn-gra-purple m-auto" title="Go to Dashboard" href="../"> Go to Home </a>
                    </div>

               </div>

          </body>

          </html>
<?php
     } else {
          echo "Something Wrong!";
     }
} else {
     header('location: ../');
}
