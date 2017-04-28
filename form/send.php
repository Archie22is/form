<?php

	include_once '../config.php';
	include_once '../lib/recaptchalib.php';

	$secretKey = '' . $recaptcha_secret_key . '';
	$response = false;
	$err_message = '';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(!empty($_POST['g-recaptcha-response'])) {
			$objRecaptcha = new ReCaptcha($secretKey);
			$response = $objRecaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response']);
		}

		if(isset($response->success) && 1 == $response->success) {

			// Get content posted from contact form
			$name = $_REQUEST['name'];
			$email = $_REQUEST['email'];
			$message = $_REQUEST['message'];
			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <title>New career enquiry from website</title> </head> <body style="height: 100%;margin: 0;line-height: 1.4;background-color: #F2F4F6;color: #74787E;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;width: 100% !important;"> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;background-color: #F2F4F6;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td align="center" style="word-break: break-word;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="word-break: break-word;width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFFFFF;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="width: 570px;margin: 0 auto;padding: 0;-premailer-width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;background-color: #FFFFFF;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td class="content-cell" style="word-break: break-word;padding: 35px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <h1 style="margin-top: 0;color: #2F3133;font-size: 19px;font-weight: bold;text-align: left;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;">' . $site_name . '</h1> <br><h2 style="margin-top: 0;color: #2F3133;font-size: 16px;font-weight: bold;text-align: left;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;">Contact Form Message</h2> <table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 21px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td class="attributes_content" style="word-break: break-word;background-color: #EDEFF2;padding: 16px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td class="attributes_item" style="word-break: break-word;padding: 0;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"><p style="line-height: 1.5em;text-align: left;margin-top: 0;color: #74787E;font-size: 16px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;">';
			$body .= '<strong>Name:</strong> ' . $name . '<br>';
			$body .= '<strong>Email:</strong> ' . $email . '<br>';
			$body .= '<strong>Message:</strong><br> ' . $message . '<br>';
			$body .= '</p></td></tr></table> </td></tr></table> </td></tr></table> </td></tr></table> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="width: 570px;margin: 0 auto;padding: 0;-premailer-width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;text-align: center;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <tr> <td class="content-cell" style="word-break: break-word;padding: 35px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"> <p style="line-height: 1.5em;text-align: left;margin-top: 0;color: #AEAEAE;font-size: 16px;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;"><a href="http://matthewjrallen.com" style="color: #3869D4;font-family: Arial, Helvetica, sans-serif;box-sizing: border-box;">Email Sent by Matt</a></p></td></tr></table> </td></tr></table> </body></html>';

			// Require PHPMailer
			require('../lib/PHPMailer-5.2.23/PHPMailerAutoload.php');

			$mail = new PHPMailer();

			// set mailer to use SMTP
			$mail->IsSMTP();

			// Specifiy mailserver details
			$mail->Host = '' . $smtp_host . '';
			$mail->SMTPAuth = $smtp_auth;
			$mail->SMTPSecure = '' . $smtp_secure . '';
			$mail->Port = $smtp_port;
			$mail->Username = '' . $smtp_username . '';
			$mail->Password = '' . $smtp_password . '';

			// Debugging
			if ($debug == '1') {
				$mail->SMTPDebug = 2;
			}

			// Email settings
			$mail->From = '' . $mail_from_email . '';
			$mail->FromName = '' . $mail_from_name . '';
			$mail->AddReplyTo($email,$name);

			// below we want to set the email address we will be sending our email to
			$mail->AddAddress('' . $mail_to_email . '', '' . $mail_to_name . '');

			// set word wrap to 50 characters
			$mail->WordWrap = 50;

			// set email format to HTML
			$mail->IsHTML(true);

			$mail->Subject = '' . $mail_subject . '';

			// Set the message from the body at the top
			$mail->Body = $body;
			$mail->AltBody = $body;

			if(!$mail->Send()) {
				if ($debug == '1') {
					echo 'Message could not be sent.';
	    			echo 'Mailer Error: ' . $mail->ErrorInfo;
					exit();
				} else {
					// Forward to error page if something went wrong
					header( 'Location: ../message-error.php?e=0' );
					exit();
				}
			}

			// Forward to thank you page if all submitted correctly
			header( 'Location: ../message-success.php' );
			exit();

		} else {
			// Forward to error page if google verification replies with a bot
			header( 'Location: ../message-error.php?e=1' );
			exit();
		}
	}
?>
