<?php
session_start();
require_once '../connect/connectDb/config.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$done = "Started ...        ";

$q = "SELECT * FROM `78000_user` WHERE 1";
$fire_q = mysqli_query($link, $q);

if (mysqli_num_rows($fire_q) > 0) {

	while ($a = mysqli_fetch_assoc($fire_q)) {

		//Load Composer's autoloader
		require '../dashboard/PHPMailer/Exception.php';
		require '../dashboard/PHPMailer/PHPMailer.php';
		require '../dashboard/PHPMailer/SMTP.php';


		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'website.yastiwari@gmail.com';
			$mail->Password   = 'WebsiteisthePassword';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			//Recipients
			$mail->setFrom('website.yastiwari@gmail.com', 'YasTiwari.com');
			$mail->addAddress($a['userEmail'], $a['userFullName']);

			//Content
			$mail->isHTML(true);
			$mail->Subject = 'Thanks for Registering on YasTiwari.com';
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
								<a href="https://www.yastiwari.com/"><img src="https://www.yastiwari.com/media/Mail/Header_Brand.png" alt="YasTiwari Logo" title="YasTiwari Logo" width="200" style="border: 0;padding: 40px 0;"></a>
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
								<a href="javascript:void(0)"><img src="https://www.yastiwari.com/media/Mail/undraw_welcome_cats_thqn.png" alt="Welcome Illustration" title="YasTiwari Logo" style="border: 0; max-width: 300px; width: 90%;"></a>
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
								Hey ' . $a['userFullName'] . ',<br>
                    <strong style="font-weight: 600; color: #040b1b;">
                         Thanks for Registering on Yastiwari.com
                    </strong><br>
				<strong style="font-weight: 600; color: #0080ff;">
                         Go to YasTiwari.com and Sign In to Explore More!
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
								<a href="https://www.yastiwari.com/" style="background-color: #0080ff; color: #ffffff; text-decoration: none; padding: 10px 40px;" title="Verify"> Lets Explore </a>
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
                    YasTiwari.com<br>
                    [ <strong style="font-weight: 600; color: #0080ff;">Complete Solution </strong> for New Creators ]<br>
                    [ <strong style="font-weight: 600; color: #0080ff;">Your Growth </strong> is our AIM ]<br><br>
                    
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
									<a href="https://www.instagram.com/itsYasTiwari/" style="text-decoration: none; font-size: 22px;" title="instagram">
										<img src="https://www.yastiwari.com/media/Mail/instagram.png" alt="Instagram Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.facebook.com/itsYasTiwari/" style="text-decoration: none; font-size: 22px; margin: 0 20px;" title="facebook">
										<img src="https://www.yastiwari.com/media/Mail/facebook.png" alt="Facebook Icon" width="22" style="border: 0;">
									</a>

                                             <a href="https://www.youtube.com/YasTiwari" style="text-decoration: none; font-size: 22px; margin-right:20px;" title="facebook">
										<img src="https://www.yastiwari.com/media/Mail/youtube.png" alt="youtube Icon" width="22" style="border: 0;">
									</a>

									<a href="https://www.twitter.com/itsYasTiwari/" style="text-decoration: none; font-size: 22px;" title="twitter">
										<img src="https://www.yastiwari.com/media/Mail/twitter.png" alt="Twitter Icon" width="22" style="border: 0;">
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
						<p style="margin: 10px 0; font-size: 12px; font-weight: 500;">&copy; Yastiwari.com All rights reserved</p>
					</table>
				</td>
			</tr>


		</table>

	</center>

</body>

</html> ';

			$mail->send();
			$done .= "User" . $a['userId'] . "Done           ";
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	echo $done;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Send thanks</title>
</head>
<body>
	<form action="./sendthanks.php" method="post">

	<input type="number" name="newuser" placeholder="userid" requireq>
	<button type="submit">Send</button>
</form>
	
</body>
</html>