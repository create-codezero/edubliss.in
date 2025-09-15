<?php
session_start();
require_once '../../connect/connectDb/config.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['sendEmails'])) {
     $sendto = mysqli_escape_string($link, $_POST['sendto']);
     $sendtoArray = explode(",", $sendto);
     $subject = mysqli_escape_string($link, htmlentities($_POST['subject']));
     $mailId = mysqli_escape_string($link, htmlentities($_POST['mailId']));
     $defaultHeader = mysqli_escape_string($link, htmlentities($_POST['defaultHeader']));
     $defaultFooter = mysqli_escape_string($link, htmlentities($_POST['defaultFooter']));
     $sendToUser = mysqli_escape_string($link, htmlentities($_POST['sendToUser']));
     $ctaAlignment = mysqli_escape_string($link, htmlentities($_POST['ctaAlignment']));
     $footerAlignment = mysqli_escape_string($link, htmlentities($_POST['footerAlignment']));


     // GETTING MAIN CONTENT

     $q2 = "SELECT * FROM `78000_emails` WHERE `emailId` = '$mailId'";
     $fireq2 = mysqli_query($link, $q2);
     if (mysqli_num_rows($fireq2) > 0) {
          while ($q2Data = mysqli_fetch_assoc($fireq2)) {
               $content = $q2Data['emailContent'];
          }
     }


     // Defining a callback function
     function myFilter($var)
     {
          return ($var !== NULL && $var !== FALSE && $var !== "");
     }



     // Filtering the array
     $filteredSendtoArray = array_filter($sendtoArray, "myFilter");



     // GETTING ALL USERS

     if ($sendToUser == 'Yes') {
          $selectAllUser = "SELECT * FROM `78000_user`";
          $fireSelectAllUser = mysqli_query($link, $selectAllUser);

          $totalUserCount = mysqli_num_rows($fireSelectAllUser);

          if ($totalUserCount > 1) {
               while ($alluser = mysqli_fetch_assoc($fireSelectAllUser)) {
                    $userEmail = $alluser['userEmail'];
                    array_push($filteredSendtoArray, $userEmail);
               }
          }
     }



     // Email Array length and how much email send in one time
     $sendtoArrayLength = count($filteredSendtoArray);



     $ctaCode = '';
     $imageCode = '';
     $headerCode = '';




     if ($defaultHeader == "Yes") {
          $headerCode = '<tr>
                    <td style="background-color: #ffffff;padding: 0;font-family: Poppins;">
                         <table style="width: 100%;border-spacing: 0;">
                              <tr>
                                   <td style="text-align: center;padding: 30px 0;font-family: Poppins;">
                                        <a href="https://www.edubliss.in/"><img src="https://www.edubliss.in/media/Mail/Header_Brand.png" alt="YasTiwari Logo" title="YasTiwari Logo" width="170" style="border: 0;"></a>
                                   </td>
                              </tr>
                         </table>
                    </td>
               </tr>';
     } else {
          $headerCode = '';
     }



     // PREPARING FIRST CALL TO ACTION BUTTON

     if (!empty($_POST['link1']) && !empty($_POST['btn1'])) {
          $link1 = mysqli_escape_string($link, $_POST['link1']);
          $btn1 = mysqli_escape_string($link, htmlentities($_POST['btn1']));
          $ctaCode .= '<table style="padding: 10px 0;width: max-content;margin: auto;border-spacing: 0;">
                              <tr>
                                   <td style="text-align: ' . $ctaAlignment . ';padding: 0;font-family: Poppins;">
                                        <a href="' . $link1 . '" style="background-color: #1668ff; color: #ffffff; text-decoration: none; padding: 8px 30px; border-radius: 5px; font-size: 15px;" title="' . $btn1 . '"> ' . $btn1 . ' </a>
                                   </td>
                              </tr>
                         </table>';
     }


     // PREPARING SECOND CALL TO ACTION BUTTON

     if (!empty($_POST['link2']) && !empty($_POST['btn2'])) {
          $link2 = mysqli_escape_string($link, $_POST['link2']);
          $btn2 = mysqli_escape_string($link, htmlentities($_POST['btn2']));
          $ctaCode .= '<table style="padding: 10px 0;width: max-content;margin: auto;border-spacing: 0;">
                              <tr>
                                   <td style="text-align: ' . $ctaAlignment . ';padding: 0;font-family: Poppins;">
                                        <a href="' . $link2 . '" style="background-color: #1668ff; color: #ffffff; text-decoration: none; padding: 8px 30px; border-radius: 5px; font-size: 15px;" title="' . $btn2 . '"> ' . $btn2 . ' </a>
                                   </td>
                              </tr>
                         </table>';
     }

     if ($defaultFooter == "Yes") {
          $footerContent = '<tr>
                    <td style="padding: 0;font-family: Poppins;">
                         <table style="width: 90%;margin: auto;border-spacing: 0;">
                              <tr>
                                   <td style="padding: 0;font-family: Poppins;">
                                        <p style="margin: 0 0; font-weight: 500; text-align: ' . $footerAlignment . '; line-height: 17px; font-size:14px;">
                                             Mail from,<br>
                                             Edubliss.in<br>
                                             <img src="https://www.edubliss.in/media/Mail/signature.png" style="max-height: 50px;padding: 5px 0;border: 0;">

                                        </p>
                                   </td>
                              </tr>
                         </table>
                    </td>
               </tr>';
     } else {
          $footerContent = "";
     }


     // GETTING EMAIL IMAGE AND SAVING

     if (!empty($_FILES['Mail_Image']['name']) || $_FILES['Mail_Image']['size'] != 0) {
          // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
          $temp = $_FILES["Mail_Image"]["name"];
          $file_name = str_replace(' ', '', $temp);

          // GETTING THE THUMBNAIL FILE DATA
          $file_type = $_FILES["Mail_Image"]["type"];
          $temp_name = $_FILES["Mail_Image"]["tmp_name"];
          $file_size = $_FILES["Mail_Image"]["size"];
          $error = $_FILES["Mail_Image"]["error"];

          $imageSaveFolder = "../../data/admin/emailImage/" . $file_name;

          // IF THE TOTAL IMAGE ERROR IS ZERO THEN FINALLY HERE WE COMPRESS THE FILE AND SAVE IT 
          if ($error > 0) {
               header('location: ../');
          } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
               $fileUploaded = move_uploaded_file($temp_name, $imageSaveFolder);
               if ($fileUploaded) {
                    $Image = $file_name;
                    $ImageLink = mysqli_escape_string($link, $_POST['imageLink']);

                    $imageCode = '<tr>
                    <td style="background-color: #ffffff;padding: 0;font-family: Poppins;">
                         <table style="width: 100%;border-spacing: 0;">
                              <tr>
                                   <td style="text-align: center;padding: 0;font-family: Poppins;">
                                        <a href="' . $ImageLink . '"><img src="https://www.edubliss.in/data/admin/emailImage/' . $Image . '" style="width: 100%;border: 0;"></a>
                                   </td>
                              </tr>
                         </table>
                    </td>
               </tr>';
               }
          } else {
               header('location: ../');
          }
     }



     // PREPARING FULL CONTENT

     $fullContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
</head>

<body style="margin: 0;max-width: 800px;background-color: #ffffff !important;">

     <center class="wrapper" style="width: 100%;padding-bottom: 40px;table-layout: fixed;color: #040b1b;background-color: #ffffff !important;">

          <table class="main" style="border-spacing: 0;width: 100%;max-width: 600px;margin: 0 auto;background-color: #ffffff !important;">

               <tr style="margin-bottom:10px;">
                    <td style="background-color: #0066ff;width: 100%;padding: 0;font-family: Poppins;" height="10">
                         <table style="width: 100%;border-spacing: 0;">
                         </table>
                    </td>
               </tr>

               ' . $headerCode . '

               ' . $imageCode . '

               <tr >
                    <td style="padding: 0;font-family: Poppins;">
                         <table style="width: 90%;margin: auto;border-spacing: 0;">
                              <tr>
                                   <td style="padding: 0;font-family: Poppins;">
                                   ' . $content . '
                                   </td>
                              </tr>
                         </table>
                    </td>
               </tr>
               <tr>
                    <td style="background-color: #ffffff;text-align: center;padding: 0;font-family: Poppins;">
                         ' . $ctaCode . '
                    </td>
               </tr>
               <tr>
                    <td style="padding: 0;font-family: Poppins;">
                         <table style="width: 100%;border-spacing: 0;">
                              <div style="height: 2px; width: 80%; background-color: #b1b1b1; margin:10px auto;"></div>
                         </table>
                    </td>

               </tr>

               ' . $footerContent . '


               <!-- FOOTER SECTION -->

               <tr>
                    <td style="text-align: center;padding-top: 20px;padding: 0;font-family: Poppins;">
                         <table style="width: 100%;text-align: center;border-spacing: 0;">
                              <tr>
                                   <div style="background-color: #ffffff;margin-top: 10px;">
                                        <a href="https://www.instagram.com/#" style="text-decoration: none; font-size: 22px;" title="instagram">
                                             <img src="https://www.edubliss.in/media/Mail/instagram.png" alt="Instagram Icon" width="22" style="border: 0;">
                                        </a>

                                        <a href="https://www.facebook.com/#" style="text-decoration: none; font-size: 22px; margin: 0 20px;" title="facebook">
                                             <img src="https://www.edubliss.in/media/Mail/facebook.png" alt="Facebook Icon" width="22" style="border: 0;">
                                        </a>

                                        <a href="https://www.youtube.com/#" style="text-decoration: none; font-size: 22px; margin-right:20px;" title="facebook">
                                             <img src="https://www.edubliss.in/media/Mail/youtube.png" alt="youtube Icon" width="22" style="border: 0;">
                                        </a>

                                        <a href="https://www.twitter.com/#" style="text-decoration: none; font-size: 22px;" title="twitter">
                                             <img src="https://www.edubliss.in/media/Mail/twitter.png" alt="Twitter Icon" width="22" style="border: 0;">
                                        </a>
                                   </div>
                              </tr>
                         </table>
                    </td>
               </tr>

               <tr>
                    <td style="background-color: #f0f0f0;width: 100%;text-align: center;padding: 0;font-family: Poppins;">
                         <table style="width: 100%;border-spacing: 0;">
                              <p style="margin: 10px 0; font-size: 12px; font-weight: 500;">&copy; EduBliss.in All rights reserved</p>
                         </table>
                    </td>
               </tr>

               <tr>
                    <td style="padding: 0;font-family: Poppins;background-color: #f0f0f0;width: 100%;" width=" 100%" bgcolor="#f0f0f0" align="center">
                         <table style="border-spacing: 0;width: 100%;text-align: center;" width="100%">
                              <p style="margin: 10px 0; font-size: 12px; font-weight: 500;">Don&apos;t want to Receive more <a href="https://www.edubliss.in/unsubscribe-mail/">Unsubscribe Here!</a></p>
                         </table>
                    </td>
               </tr>

               <!-- BLUE BORDER -->
               <tr>
                    <td style="background-color: #0066ff;width: 100%;padding: 0;font-family: Poppins;" height="10">
                         <table style="width: 100%;border-spacing: 0;">
                         </table>
                    </td>
               </tr>


          </table>

     </center>

</body>

</html>
               ';



     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $jsonEmailList = json_encode($filteredSendtoArray);


     $q3 = "INSERT INTO `78000_email_history`(`emailHeader`, `emailSubject`, `emailContent`, `emailToAllUser`, `emailList`, `emailTotalTargeted`, `emailTotalSent`, `emailDropped`, `emailSentOn`) VALUES ('$defaultHeader','$subject','$fullContent','$sendToUser','$jsonEmailList','$sendtoArrayLength','0','0','$dateTime')";

     $fireq3 = mysqli_query($link, $q3);

     if ($fireq3) {
          $_SESSION['emailList'] = $jsonEmailList;
          $_SESSION['subject'] = $subject;
          $_SESSION['mailContent'] = $fullContent;
          $_SESSION['adminDPage'] = "EmailProcessing";

          header('location: ../');
     } else {
          echo "error";
     }
}
 