<?php
include "evenement.php";
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
$email=$_POST['email'];
$password=$_POST['password'];
$confirmationp=$_POST['confirmationp'];

$bdd->exec( "INSERT INTO inscription(`nom`,`prenom`, `adresse`, `email`, `password`, `confirmationp`, `confirmkey`)	VALUES ('$nom','$prenom', '$adresse', '$email', '$password', '$confirmationp', '?')" );
	    
?>