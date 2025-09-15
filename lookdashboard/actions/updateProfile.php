<?php
session_start();
require_once "../../connect/connectDb/config.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$userDetails = $_SESSION['userDetails'];


if (isset($_POST['updateProfile'])) {
     $logoLink = "";
     $userId = $_SESSION['userDetails'][0];

     //getting input value
     $userFullName = mysqli_real_escape_string($link, $_POST['userFullName']);
     $userEmail = mysqli_real_escape_string($link, $_POST['userEmail']);
     $userPhone = mysqli_real_escape_string($link, $_POST['userPhone']);

     $oldProfile = mysqli_real_escape_string($link, $_POST['logoLink']);

     if (!empty($_FILES['newProfileLink']['name']) || $_FILES['newProfileLink']['size'] != 0) {
          // RENAMING THE IMGAGE FILE SO THAT THE FILE NAME WILL NOT BE SAME . HERE IMG FILE IS RENAMED ON THE BASIS OF VIDEO UNIQUE ID AND ABOVE WE CHECKED THAT, THAT UNIQUE ID IS NOT IN DATABASE
          $temp = explode(".", $_FILES["newProfileLink"]["name"]);

		  //TIME AND DATE 
		  date_default_timezone_set('Asia/Calcutta');
		  $date = date("Y-m-d");
		  $time = date("H:i:s");

		  $dateTime = $date . "_" . $time;
          $file_name = md5($userId) . "." . end($temp);

          // GETTING THE PROFILE FILE DATA
          $file_type = $_FILES["newProfileLink"]["type"];
          $temp_name = $_FILES["newProfileLink"]["tmp_name"];
          $file_size = $_FILES["newProfileLink"]["size"];
          $error = $_FILES["newProfileLink"]["error"];

          // THIS FUNCTION COMPRESS THE PROFILE FILE
          function compress_image($source_url, $destination_url, $quality)
          {
               $info = getimagesize($source_url);
               if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
               elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
               elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
               imagejpeg($image, $destination_url, $quality);
               return "Image uploaded successfully.";
          }

          // IF THE TOTAL IMAGE ERROR IS ZERO THEN FINALLY HERE WE COMPRESS THE FILE AND SAVE IT 
          if ($error > 0) {
            //    header('location: ../');
            echo " error greater than one";
          } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
               $filename = compress_image($temp_name, "../../data/user/userProfile/" . $file_name, 20);
               if ($filename = "Image uploaded successfully.") {
                    $logoLink = $file_name. "?i=" . $dateTime;

               }else{
                    echo "file not uploaded!";
               }
          } else {
            //    header('location: ../');
            echo "unknown error";
          }
     }else{
          $logoLink = $oldProfile;
     }

          // UPDATE USER TABLE

          $updateUserLogoQuery = "UPDATE `78000_user` SET `userFullName`= '$userFullName', `userEmail` = '$userEmail', `userPhone` = '$userPhone', `userLogo`='$logoLink' WHERE `userId` = '$userId'";
          $fireUpdateUserLogoQuery = mysqli_query($link, $updateUserLogoQuery);

		  // UPDATING COMMENT AND POST TABLE PROFILE IMAGE & OTHER DATA

		  $qforPost = "UPDATE `78000_posts` SET `userFullName`='$userFullName',`userLogo`='$logoLink' WHERE `userId` = '$userId'";
					
		  $qforComment = "UPDATE `78000_postcomment` SET `userName`='$userFullName',`userLogo`='$logoLink' WHERE `userId` = '$userId'";

		  $fireqforPost = mysqli_query($link, $qforPost);
		  $fireqforComment = mysqli_query($link, $qforComment);

          //Updating session
          $_SESSION['userDetails'][9] = $logoLink;
          $_SESSION['userDetails'][1] = $userFullName;
          $_SESSION['userDetails'][2] = $userEmail;
          $_SESSION['userDetails'][10] = $userPhone;


          if($userEmail != $_SESSION['userDetails'][2]){

               //update user to be not verified
               $updateUserLogoQuery = "UPDATE `78000_user` SET `userVerified` = '0' WHERE userId = '$userId'";
               $fireUpdateUserLogoQuery = mysqli_query($link, $updateUserLogoQuery);

               //update userdetails userverified session
               $_SESSION['userDetails'][6] = 0;

               // NEW USER NOTIFICATION DATA
			$notificationmms = array('Your Email is not Verified. Click Verify to verify your Email.', 'javascript:void(0)', '2', 'Verify', "clickOn('verification-pop')", 'Clear', 'clearThisNotification(this)', '');

			//QUERY TO INSERT NOTIFICATION FOR NEW USER
			$verificationnotification = 'INSERT INTO `78000_notification`(`notificationText`, `notificationHref`, `notificationActionCount`, `notificationAction1`, `notificationDoAction1`, `notificationAction2`, `notificationDoAction2`, `notificationSuccessMsg`, `notifyUserId`, `notifyUserUniCode`) VALUES ("' . $notificationmms[0] . '","' . $notificationmms[1] . '",' . $notificationmms[2] . ',"' . $notificationmms[3] . '","' . $notificationmms[4] . '","' . $notificationmms[5] . '","' . $notificationmms[6] . '","' . $notificationmms[7] . '",' . $userDetails[0] . ',"' . $_SESSION['userDetails'][5] . '")';
			// FIRED THE QUERY TO INSERT NOTIFICATION FOR NEW USER
			mysqli_query($link, $verificationnotification);
               

               //Load Composer's autoloader
					require '../../../PHPMailer/Exception.php';
					require '../../../PHPMailer/PHPMailer.php';
					require '../../../PHPMailer/SMTP.php';


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
						$mail->setFrom('website.edubliss@gmail.com', 'Edubliss.in');
						$mail->addAddress($userDetails[2], $userDetails[1]);

						//Content
						$mail->isHTML(true);
						$mail->Subject = 'Thanks for Registering on Edubliss.in';
						$mail->Body    = '
                              <!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>

<body style="margin: 0; background-color: #ffffff;">

	<center class="wrapper" style="width: 100%; padding-bottom: 40px; table-layout: fixed; background-color: #ffffff; color: #040b1b;">

		<table class="main" style="border-spacing: 0; width: 100%; max-width: 600px; background-color: #ffffff; margin: 0 auto;" width="100%" bgcolor="#ffffff">

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #0066ff; width: 100%;" height="10" width="100%" bgcolor="#0066ff">
					<table style="border-spacing: 0; width: 100%;" width="100%">
					</table>
				</td>
			</tr>

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #ffffff;" bgcolor="#ffffff">
					<table style="border-spacing: 0; width: 100%;" width="100%">
						<tr>
							<td style="font-family: "Poppins", sans-serif; text-align: center; " align="center">
								<a href="https://www.edubliss.in/"><img src="https://www.edubliss.in/media/Mail/Header_Brand.png" alt="EduBliss Logo" title="EduBliss Logo" width="200" style="border: 0;padding: 40px 0;"></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>

               <tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #ffffff;" bgcolor="#ffffff">
					<table style="border-spacing: 0; width: 100%;" width="100%">
						<tr>
							<td style="font-family: "Poppins", sans-serif; text-align: center; padding: 40px 0;" align="center">
								<a href="javascript:void(0)"><img src="https://www.edubliss.in/media/Mail/undraw_welcome_cats_thqn.png" alt="Welcome Illustration" title="EduBliss Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif;">
					<table style="border-spacing: 0; width: 90%; margin: auto;" width="90%">
						<tr>
							<td style="padding: 0; font-family: "Poppins", sans-serif;">
								<p style="margin: 0 0; font-weight: 500;">
								Hey ' . $userDetails[1] . ',<br>
                    <strong style="font-weight: 600; color: #040b1b;">
                         Thanks for Registering on Edubliss.in
                    </strong><br>
				<strong style="font-weight: 600; color: #0080ff;">
                         Go to Edubliss.in and Sign In to Explore More!
                    </strong><br><br>
					</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
               <tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #ffffff; text-align: center;" bgcolor="#ffffff" align="center">
					<table style="border-spacing: 0; padding: 15px 0; width: max-content; margin: auto;">
						<tr>
							<td style="padding: 0; font-family: "Poppins", sans-serif; text-align: center;" align="center">
								<a href="https://www.edubliss.in/" style="background-color: #0080ff; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="Verify"> Lets Explore </a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
               <tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif;">
					<table style="border-spacing: 0; width: 90%; margin: auto;" width="90%">
						<tr>
							<td style="padding: 0; font-family: "Poppins", sans-serif;">
								<p style="margin: 0 0; font-weight: 500;">
				Mail from,<br>
                    Edubliss.in<br>
                    [ <strong style="font-weight: 600; color: #FFAA48;">Refining Excellence </strong>to Achieve a Legendary Legacy]<br><br>
                    
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<!-- FOOTER SECTION -->
               <tr style="margin-top: 10px;">
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #f0f0f0; width: 100%; " width="100%" bgcolor="#f0f0f0" align="center">
					<table style="border-spacing: 0; width: 100%;text-align: center;" width="100%">
						<p style="margin: 10px 0; font-size: 20px; font-weight: 500;">Join Us on:</p>
					</table>
				</td>
			</tr>

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; text-align: center;;" align="center">
					<table style="border-spacing: 0; width: 100%; text-align: center;" width="100%" align="center">
							<tr>
								<div style="background-color: #ffffff;margin-top: 10px;">
									<a href="https://www.instagram.com//" style="text-decoration: none; font-size: 22px;" title="instagram">
										<img src="https://www.edubliss.in/media/Mail/instagram.png" alt="Instagram Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.facebook.com//" style="text-decoration: none; font-size: 22px; margin: 0 20px;" title="facebook">
										<img src="https://www.edubliss.in/media/Mail/facebook.png" alt="Facebook Icon" width="22" style="border: 0;">
									</a>

                                             <a href="https://www.youtube.com/" style="text-decoration: none; font-size: 22px; margin-right:20px;" title="facebook">
										<img src="https://www.edubliss.in/media/Mail/youtube.png" alt="youtube Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.twitter.com//" style="text-decoration: none; font-size: 22px;" title="twitter">
										<img src="https://www.edubliss.in/media/Mail/twitter.png" alt="Twitter Icon" width="22" style="border: 0;">
									</a>
								</div>
							</tr>
					</table>
				</td>
			</tr>
			<!-- BLUE BORDER -->
			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #0066ff; width: 100%;" height="10" width="100%" bgcolor="#0066ff">
					<table style="border-spacing: 0; width: 100%;" width="100%">
					</table>
				</td>
			</tr>

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #f0f0f0; width: 100%; " width="100%" bgcolor="#f0f0f0" align="center">
					<table style="border-spacing: 0; width: 100%;text-align: center;" width="100%">
						<p style="margin: 10px 0; font-size: 12px; font-weight: 500;">&copy; Edubliss.in All rights reserved</p>
					</table>
				</td>
			</tr>


		</table>

	</center>

</body>

</html> ';

						$mail->send();
					} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}


          }
          

          if($fireUpdateUserLogoQuery){
            
            header("location: ../");
          }
     
}else{
    echo "not click on submit button";
}
