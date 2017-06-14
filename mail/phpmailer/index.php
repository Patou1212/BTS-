<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp-relay.sendinblue.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'afannoukevine@gmail.com';                 // SMTP username
$mail->Password = 'ADZBUrKLS24pmjPT';                           // SMTP password
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'kevineafannou@outlokk.fr';
$mail->FromName = 'kevine afannou';
$mail->addAddress('who_are_you_sending@to.com');               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Confirmer votre email';
}