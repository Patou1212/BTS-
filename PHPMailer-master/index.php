<?php
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'email@gmail.com';            // SMTP username
$mail->Password = 'password';                     // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 25;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('info@mail.com',    'Repair Am');                      //Set who the message is to be sent from
$mail->addReplyTo('info@mail.com', 'Repair Am');                     //Set an alternative reply-to address
//$mail->addAddress($mail,$CompanyName);               // Name is optional

// $mail->addCC('cc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'ORDER';
$mail->Body    = '<span style="font-family:calibri;"><br>You Can Track Your Order With This </span>';


if(!$mail->send()) {
   echo '<div class="calibri" style="margin-left:2%"> Hey! A Message containing your order details could not be sent.</div>';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
}

echo '<div class="calibri" style="margin-left:2%">Hey! A Message containing info has been sent to you.</div>';