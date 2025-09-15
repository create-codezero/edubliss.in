<?php
session_start();
require_once '../../connect/connectDb/config.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['mailto']) && isset($_SESSION['emailList']) && isset($_SESSION['subject']) && isset($_SESSION['mailContent'])) {
     $mailTo = json_decode($_POST['mailto']);
     $subject = $_SESSION['subject'];
     $content = $_SESSION['mailContent'];
     $length = count(json_decode($_POST['mailto']));

     //Load Composer's autoloader
     require '../../PHPMailer/Exception.php';
     require '../../PHPMailer/PHPMailer.php';
     require '../../PHPMailer/SMTP.php';


     //Create an instance; passing `true` enables exceptions 
     $mail = new PHPMailer(true);

     try {
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'website.edubliss@gmail.com';
          $mail->Password   = 'vbiubwzyovrmxlyt';
          $mail->SMTPSecure = 'tls';
          $mail->Port       = 587;

          //Recipients
          $mail->setFrom('website.edubliss@gmail.com', 'EduBliss');

          $i = 0;

          while ($i < $length){
               $mail->addBCC($mailTo[$i]);

               $i++;
          }

          // $mail->addAddress($sendto);


          //Content
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body = $content;

          $mail->send();

          echo 1;
     } catch (Exception $e) {
          echo 0;
     }
}
