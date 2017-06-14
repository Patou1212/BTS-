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

$bdd->exec( 'SELECT * FROM inscription WHERE nom= :nom, prenom= :prenom, password= :password' );
$datas = array($nom,$prenom, $password);
try{
   $prep= $bdd->prepare($bdd);
   $prep->execute($datas);
   $a_result = $prep->fetchAll();
   $nbResult =  !empty($a_result) ? count($a_result) : 0;
}catch(Exception $e){
  echo " Erreur : " . $e->getMessage();
}



?>

