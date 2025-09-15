<?php
session_start();
require_once '../../connect/connectDb/config.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['post_id'])) {
     $post_id = $_POST['post_id'];
     $oldHeartCount = $_POST['oldHeartCount'];
     $userUniqueCode = $_SESSION['userUniqueCode'];


     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;



     $check = "SELECT * FROM `78000_postheart` WHERE `userUniqueCode` = '$userUniqueCode' AND `postId` = '$post_id'";
     $check_fire = mysqli_query($link, $check);
     if (mysqli_num_rows($check_fire) > 0) {
          $sql = "DELETE FROM `78000_postheart` WHERE `userUniqueCode` = '$userUniqueCode' AND `postId` = '$post_id'";
          $fire = mysqli_query($link, $sql);

          $nowHeartCount = $oldHeartCount - 1;

          $updateOnPostTable = "UPDATE `78000_posts` SET `totalLike`='$nowHeartCount' WHERE postSrNo = '$post_id'";
          $fireUpdateOnePostTable = mysqli_query($link, $updateOnPostTable);

          echo $nowHeartCount;
     } else {
          $sql = "INSERT INTO `78000_postheart`(`userUniqueCode`, `postId`, `heartTime`) VALUES ('$userUniqueCode','$post_id','$dateTime')";
          $fire = mysqli_query($link, $sql);

          $nowHeartCount = $oldHeartCount + 1;

          $updateOnPostTable = "UPDATE `78000_posts` SET `totalLike`='$nowHeartCount' WHERE postSrNo = '$post_id'";
          $fireUpdateOnePostTable = mysqli_query($link, $updateOnPostTable);

          if ($fireUpdateOnePostTable) {

               $userFullName = $_SESSION['userDetails'][1];

               $notificationText = $userFullName . " like your post. ";

               $gettingPostUserDetails = "SELECT `userId`, `userUniqueCode`, `userFullName`, `userEmail` FROM `78000_posts` WHERE `postSrNo` = '$post_id'";

               $fireGettingPostUserDetails = mysqli_query($link, $gettingPostUserDetails);

               if (mysqli_num_rows($fireGettingPostUserDetails) > 0) {
                    while ($postUserDetails = mysqli_fetch_row($fireGettingPostUserDetails)) {
                         $postUserId = $postUserDetails['0'];
                         $postUserUniCode = $postUserDetails['1'];
                         $postUserFullName = $postUserDetails['2'];
                         $postUserEmail = $postUserDetails['3'];
                    }
               }

               $onClick = "notificationLoad('" . 'Profile-post' . $post_id . "')";

               $addUpdateNotification = 'INSERT INTO `78000_update_notification`(`updateNotificationText`, `updateNotificationHref`, `updateNotificationOnClick`, `updateNotificationUserId`, `updateNotificationUserUniqueCode`, `updateNotificationTime`, `updateNotificationShown`) VALUES ("' . $notificationText . '","javascript:void(0)"," ' . $onClick . ' ","' . $postUserId . '","' . $postUserUniCode . '","' . $dateTime . '","0")';
               $fireAddUpdateNotification = mysqli_query($link, $addUpdateNotification);

               echo $nowHeartCount;

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
					$mail->addAddress($postUserEmail, $postUserFullName);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'Your Post got a Like...';
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
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #FFAA48; width: 100%;" height="10" width="100%" bgcolor="#FFAA48">
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
								<a href="javascript:void(0)"><img src="	https://www.edubliss.in/media/Mail/undraw_love_it_heart_dxlp.png" alt="Comment" title="EduBliss Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
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
								Hey ' . $postUserFullName . ',<br>
                    <strong style="font-weight: 600; color: #040b1b;">
                         Your Post got a Like.
                    </strong><br>
				<strong style="font-weight: 600; color: #FFAA48;">
                         Click on the View button to see Like.
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
								<a href="https://www.edubliss.in/user/auth/signin/" style="background-color: #FFAA48; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="View"> View </a>
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
                    EduBliss<br>
                    [ <strong style="font-weight: 600; color: #FFAA48;">Complete Solution </strong> for Students ]<br>
                    [ <strong style="font-weight: 600; color: #FFAA48;">Your Growth </strong> is our AIM ]<br><br>
                    
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>

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
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #FFAA48; width: 100%;" height="10" width="100%" bgcolor="#FFAA48">
					<table style="border-spacing: 0; width: 100%;" width="100%">
					</table>
				</td>
			</tr>

			<tr>
				<td style="padding: 0; font-family: "Poppins", sans-serif; background-color: #f0f0f0; width: 100%; " width="100%" bgcolor="#f0f0f0" align="center">
					<table style="border-spacing: 0; width: 100%;text-align: center;" width="100%">
						<p style="margin: 10px 0; font-size: 12px; font-weight: 500;">&copy; EduBliss All rights reserved</p>
					</table>
				</td>
			</tr>


		</table>

	</center>

</body>

</html>
                              
                              
                              ';

					$mail->send();
				} catch (Exception $e) {}
          }
     }
}
