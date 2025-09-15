<?php
session_start();
require_once '../../connect/connectDb/config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['Email'])) {

	$userDetails = $_SESSION['userDetails'];
	$user_id = $_POST['userId'];
	$userenteredmail = $_POST['Email'];
	$check = "SELECT * FROM `78000_user` WHERE userId = $user_id";
	$check_email = "SELECT * FROM `78000_user` WHERE `userEmail` = '$userenteredmail'";
	$check_fire = mysqli_query($link, $check);
	$check_email_fire = mysqli_query($link, $check_email);
	if (mysqli_num_rows($check_email_fire) <= 1) {
		while ($a = mysqli_fetch_assoc($check_fire)) {
			$userdbmail = $a['userEmail'];
			$userVerificationcode = $a['userVerificationCode'];

			if ($userdbmail == $userenteredmail) {
				// User Entered Same Mail


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
					$mail->addAddress($userdbmail, $_SESSION['userDetails'][1]);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'Email Verification From EduBliss';
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
								<a href="javascript:void(0)"><img src="	https://www.edubliss.in/media/Mail/undraw_Opened_re_i38e.png" alt="EduBliss Logo" title="EduBliss Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
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
								Hey ' . $_SESSION['userDetails'][1] . ',<br>
                    <strong style="font-weight: 600; color: #040b1b;">
                         Thanks for Registering on EduBliss
                    </strong><br>
				<strong style="font-weight: 600; color: #FFAA48;">
                         Click on the Verify button to get Verified.
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
								<a href="https://www.edubliss.in/Verify?userEmail=' . $userdbmail . '&vCode=' . $userVerificationcode . '" style="background-color: #FFAA48; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="Verify"> Verify </a>
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
					echo 'Verification Mail has been sent';
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			} else {
				// User Entered Different Mail
				$q15 = "UPDATE `78000_user` SET `userEmail` = '$userenteredmail' WHERE userId = $user_id";
				$fire_q15 = mysqli_query($link, $q15);

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
					$mail->addAddress($userenteredmail, $_SESSION['userDetails'][1]);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'Email Verification From EduBliss';
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
								<a href="javascript:void(0)"><img src="	https://www.edubliss.in/media/Mail/undraw_Opened_re_i38e.png" alt="EduBliss Logo" title="EduBliss Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
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
								Hey ' . $_SESSION['userDetails'][1] . ',<br>
                    <strong style="font-weight: 600; color: #040b1b;">
                         Thanks for Registering on EduBliss
                    </strong><br>
				<strong style="font-weight: 600; color: #FFAA48;">
                         Click on the Verify button to get Verified.
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
								<a href="https://www.edubliss.in/Verify?userEmail=' . $userenteredmail . '&vCode=' . $userVerificationcode . '&enteredNewMail=yes" style="background-color: #FFAA48; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="Verify"> Verify </a>
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
                    [ <strong style="font-weight: 600; color: #FFAA48;">Refining Excellence </strong>to Achieve a Legendary Legacy]<br><br>
                    
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
					echo 'Verification Mail has been sent';
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			}
		}
	} else if (mysqli_num_rows($check_fire) > 1) {
		echo 'Email Already Have An Account';
	}
}
