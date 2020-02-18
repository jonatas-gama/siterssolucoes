<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$nome		= $_POST['nome'];
$email		= $_POST['email'];
$assunto	= $_POST['assunto'];
$mensagem	= $_POST['mensagem'];
try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'atendimento@ideawork.com.br';                     // SMTP username
		$mail->Password   = '@tendimento@rs123';                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('atendimento@ideawork.com.br');
		$mail->addAddress('jonatasgamasouza@hotmail.com');     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		// Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject 	= $assunto;
		$mail->Body    	= "Nome: $nome<br>";
		$mail->Body		.= "E-mail: $email<br>";
		$mail->Body		.= "Mensagem: $mensagem";	
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo json_encode(array('msg' => 'Mensagem enviada com sucesso.'));
	
	}catch (Exception $e) {
		echo json_encode(array('msg' => 'Houve algum erro: {$mail->ErrorInfo}'));
}