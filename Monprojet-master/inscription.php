<?php
include "evenement.php";
require 'Phpmailer/class.phpmailer.php';
try{
  // On se connecte � MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=reservation;charset=utf8', 'root', 'password');
	//mysql_select_db("inscripiton_revenus");
}
catch(Exception $e)
{
	// En cas d'ereur, on affiche un message et on arr�te tout
	die('Erreur : '.$e->getMessage());
}

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$adresse=$_POST['adresse'];
$mail=$_POST['mail'];
$password=$_POST['password'];
$confirmationp=$_POST['confirmationp'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isMail();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'nom@site.com';                 // SMTP username
$mail->Password = 'password';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
                                 // TCP port to connect to

$mail->From = 'name@site.com';
$mail->FromName = $nom;
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'SASP Contact Form';
$mail->Body = $message;
$mail->Body .= "<br /><br />Below are my contact details <br /> Name: ";
$mail->Body .= $nom;
$mail->Body .= "<br /> My email address: ";
$mail->Body .= $mail;
                               // Set email format to HTML

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message has been sent';
    header('Location: thankyou.html');
}

$bdd->exec( "INSERT INTO inscription(`nom`,`prenom`, `adresse`, `mail`, `password`, `confirmationp`, `confirmkey`)	VALUES ('$nom','$prenom', '$adresse', '$mail', '$password', '$confirmationp', '?')" );
	    
?>