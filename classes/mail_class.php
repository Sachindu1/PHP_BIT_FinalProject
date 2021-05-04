<?php

require '../../plugins/PHPMailer/PHPMailerAutoload.php';
require '../../plugins/PHPMailer/class.smtp.php';

	class mail{
		public $name;
		public $email;
		public $subject;
		public $message;


		function send_mail($c_name, $c_email, $m_subject, $m_message){
			//SMTP needs accurate times
			date_default_timezone_set('Etc/UTC');

			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			$mail->SMTPDebug = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			// $mail->Host = 'smtp.gmail.com';
			$mail->Host = 'smtp.gmail.com';
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;

			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "esofthr38@gmail.com";
			//Password to use for SMTP authentication
			$mail->Password = "!1qaz2wsX";
			//Set who the message is to be sent from
			$mail->setFrom("$c_email", "$c_name");
			//Set an alternative reply-to address
			$mail->addReplyTo("$c_email", "$c_name");
			//Set who the message is to be sent to
			$mail->addAddress('kushan.sachindu@gmail.com', 'Esoft Kandy');
			//Set the subject line
			$mail->Subject ="$m_subject";
			//Set the body
			$mail->Body ="$m_message";

			//send the message, check for errors
			// echo !extension_loaded('openssl')?"Not available":"Available";
			if (!$mail->send()) {
			    return "Mailer Error: " . $mail->ErrorInfo;
			} 
			else {
				return TRUE;
		
			}
		}
	}
?>