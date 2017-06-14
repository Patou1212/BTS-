<?php
//Démarre une nouvelle session ou reprend une session existante
session_start();

require '../Autoloader.php';
Autoloader::register();

//Si l'utilisateur a bien choisi un event dans la liste -listeEvent.php- et cliqué sur valider
 if (isset($_POST['ChoixEventExt'], $_POST['ValiderChoixEventExt'])) {
	
	$idEventExt = $_POST['ChoixEventExt'] ;
	$_SESSION['idEventExt'] = $idEventExt;

	$myEventExt = new Event();

	//la methode getInfosEvent renvoie sous forme de tableau les informations de l'evenement $idEventExt souhaité
	$tabInfosEvent = $myEventExt->getInfosEvent($idEventExt);

	//la methode getNbParticipants() renvoie le nb de participants à un evenement $idEvent
	$nbParticipants = $myEventExt->getNbParticipants($idEventExt);


	// On stocke dans des variables destinés à l'affichage dans la vue les infos de l'event contenues dans le tableau
	$idSalleExt = $tabInfosEvent['idSalleExt'];
	$titreEventExt = $tabInfosEvent['titreEventExt'];
	$dateEventExt  = $tabInfosEvent['dateEventExt'];
	$nbPlacesLeftExt = $tabInfosEvent['nbPlaceEventRestanteExt'];
	$typeEventExt  = $tabInfosEvent['typeEventExt'];

}else{
	header('location:ListeEventExt.php');
}

include '../ViewsExt/DetailEvenementExt.php';



