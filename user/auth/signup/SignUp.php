<?php
session_start();
require_once "../../../connect/connectDb/config.php";
$errors = array();

if (!isset($_SESSION['mode'])) {
	$_SESSION['mode'] = "light";
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// REGISTER USER
if (isset($_POST['SignUp'])) {
	// receive all input values from the form
	$fullName = mysqli_real_escape_string($link, $_POST['FullName']);
	$Email = mysqli_real_escape_string($link, $_POST['Email']);
	$password_1 = mysqli_real_escape_string($link, $_POST['Password']);
	$password_2 = mysqli_real_escape_string($link, $_POST['re-Password']);

	$userPhone = mysqli_real_escape_string($link, $_POST['Phone']);

	$verificationCode = bin2hex(random_bytes(16));

	// Reffral 
	if (isset($_SESSION['refId'])) {
		$refId = $_SESSION['refId'];
	} else {
		$refId = "a3163";
	}

	// Getting Last Id

	$totalUser = " SELECT `userId` FROM `78000_user` ";
	$firetotalUser = mysqli_query($link, $totalUser);
	$check_count = mysqli_num_rows($firetotalUser);

	$userfullname = str_replace(' ', '', $fullName);
	$userfullnametosmallletter = strtolower($userfullname);

	//TIME AND DATE 
	date_default_timezone_set('Asia/Calcutta');
	$date = date("Y-m-d");
	$time = date("H:i:s");

	$dateTime = $date . " " . $time;

	$unicode = $check_count + 1;

	// User Unique Code
	$pureEmail = str_replace('@gmail.com', '', $Email);
	$firstChar = substr($pureEmail, 0, 1);
	$emailLength = strlen($pureEmail);
	$secondChar = substr($pureEmail, $emailLength - 2, $emailLength - 1);

	$uniqueCode = $firstChar . bin2hex($unicode) . $secondChar;

	// username
	$username = $userfullnametosmallletter . $unicode . "_000";

	// CHECKING USER ALREADY EXIST OR NOT
	$check_user_exist = " SELECT * FROM `78000_user` WHERE userEmail = '$Email' ";
	$check_user = mysqli_query($link, $check_user_exist);
	$check_count = mysqli_num_rows($check_user);

	// IF USER DOESN'T EXIST
	if ($check_count == 0) {

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1); //encrypt the password before saving in the database

			// QUERY INSERTING DATA IN TO DATABASE
			$query = "INSERT INTO `78000_user` (`userFullName`, `userEmail`, `userPhone`, `userPassword`, `userPlan`, `userVerificationCode`,`userStatus`, `userUniqueCode`, `username`,`userLogo`, `userRegDate`, `referBy`) VALUES('$fullName', '$Email', '$userPhone', '$password', '17', '$verificationCode','user','$uniqueCode','$username','img_user.png','$dateTime','$refId')";

			// SAVING IN DATABASE QUERY FIRED
			mysqli_query($link, $query);

			//NOW SELECTING THE USER AGAIN JUST TO CHECK WHETHER USER INSERTED OR NOT
			$query1 = "SELECT * FROM `78000_user` WHERE `userEmail` = '$Email' AND `userPassword` ='$password'";
			$results = mysqli_query($link, $query1);

			//IF USER INSERTED
			if (mysqli_num_rows($results) == 1) {

				//SETTING THE COOKIES FOR SMOOTH LOGIN EXPERIENCE

				date_default_timezone_set('Asia/Calcutta');
				setcookie("userEmail", $Email, time() + (86400 * 30), '/');
				setcookie("userPassword", $password, time() + (86400 * 30), '/');

				// COOKIES SETED ABOVE


				while ($a = mysqli_fetch_assoc($results)) {

					// SAVING USER DETAILS IN VARIABLES
					$userFullName = $a['userFullName'];
					$userUniqueCode = $a['userUniqueCode'];
					$userDetails = array($a['userId'], $a['userFullName'], $a['userEmail'], $a['userPlan'], $a['userVerificationCode'], $a['userUniqueCode'], $a['userVerified'], $a['mode'], $a['mode_asked'], $a['userLogo'], $a['userPhone'], $a['userStatus']);

					// NEW USER NOTIFICATION DATA
					$notificationmms = array('Your Email is not Verified. Click Verify to verify your Email.', 'javascript:void(0)', '2', 'Verify', "clickOn('verification-pop')", 'Clear', 'clearThisNotification(this)', '');

					//QUERY TO INSERT NOTIFICATION FOR NEW USER
					$verificationnotification = 'INSERT INTO `78000_notification`(`notificationText`, `notificationHref`, `notificationActionCount`, `notificationAction1`, `notificationDoAction1`, `notificationAction2`, `notificationDoAction2`, `notificationSuccessMsg`, `notifyUserId`, `notifyUserUniCode`) VALUES ("' . $notificationmms[0] . '","' . $notificationmms[1] . '",' . $notificationmms[2] . ',"' . $notificationmms[3] . '","' . $notificationmms[4] . '","' . $notificationmms[5] . '","' . $notificationmms[6] . '","' . $notificationmms[7] . '",' . $userDetails[0] . ',"' . $uniqueCode . '")';
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
						$mail->setFrom('website.edubliss@gmail.com', 'EduBliss');
						$mail->addAddress($userDetails[2], $userDetails[1]);
						$mail->addAddress('work.edubliss@gmail.com', 'Admin');

						//Content
						$mail->isHTML(true);
						$mail->Subject = 'Thanks for Registering on EduBliss';
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
								<a href="https://www.edubliss.in/"><img src="http://www.edubliss.in/media/Mail/Header_Brand.png" alt="EduBliss Logo" title="EduBliss Logo" width="200" style="border: 0;padding: 40px 0;"></a>
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
								<a href="javascript:void(0)"><img src="http://www.edubliss.in/media/Mail/undraw_welcome_cats_thqn.png" alt="Welcome Illustration" title="EduBliss Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
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
                         Thanks for Registering on EduBliss
                    </strong><br>
				<strong style="font-weight: 600; color: #FFAA48;">
                         Go to EduBliss.in and Sign In to Explore More!
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
								<a href="http://www.edubliss.in/" style="background-color: #FFAA48; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="Verify"> Lets Explore </a>
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
                    EduBliss.in<br>
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
									<a href="https://www.instagram.com/#" style="text-decoration: none; font-size: 22px;" title="instagram">
										<img src="http://www.edubliss.in/media/Mail/instagram.png" alt="Instagram Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.facebook.com/#" style="text-decoration: none; font-size: 22px; margin: 0 20px;" title="facebook">
										<img src="http://www.edubliss.in/media/Mail/facebook.png" alt="Facebook Icon" width="22" style="border: 0;">
									</a>

                                             <a href="https://www.youtube.com/#" style="text-decoration: none; font-size: 22px; margin-right:20px;" title="facebook">
										<img src="http://www.edubliss.in/media/Mail/youtube.png" alt="youtube Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.twitter.com/#" style="text-decoration: none; font-size: 22px;" title="twitter">
										<img src="http://www.edubliss.in/media/Mail/twitter.png" alt="Twitter Icon" width="22" style="border: 0;">
									</a>
								</div>
							</tr>
					</table>
				</td>
			</tr>
			<!-- BLUE BORDER -->
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

</html> ';

						$mail->send();
					} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
				}

				// STORING USER DETAILS VARIABLES IN SESSIONS
				$_SESSION['userDetails'] = $userDetails;
				$_SESSION['userFullName'] = $userFullName;
				$_SESSION['userUniqueCode'] = $userUniqueCode;
				$_SESSION['reg_success'] = "You are now Registered and Signed In !";


				// //Redirecting User to Dashborad
				if (!isset($_SESSION['pathishere'])) {
					header('location: ../../../dashboard/');
				} else {
					$path = $_SESSION['pathishere'];
					header('location: ' . $path . '');
				}
			} else {
				$_SESSION['user_exist'] = "User not registered!";
				header('location: ./');
			}
		}
	} else {
		$_SESSION['user_exist'] = "User Already Exists!";
		header('location: ./');
	}
} else {
	echo "here without clicking on button :) very bad manner ";
	header('location: ../../../');
}
