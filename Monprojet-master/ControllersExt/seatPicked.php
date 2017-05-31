<?php
session_start();
require '../Autoloader.php';
Autoloader::register();


if(isset($_GET['nomPersonne']))
{
	$idEvent = $_SESSION['idEvent'];
	$returnMessage = '';
	$nomPersonne = $_GET['nomPersonne'];
	$prenomPersonne = $_GET['prenomPersonne'];
	$mailPersonne = $_GET['mailPersonne'];	
	$placesAchetees = $_GET['placesAchetees'];
	$tabPlacesAchetees = explode(",", $placesAchetees);
	//Instanciation de l'objet Personne
	$Personne = new Personne($mailPersonne, $nomPersonne, $prenomPersonne);
	//On utilise la methode isMailAvailable sur l'objet Personne pour vérifier la disponibilité du mail
	$isMailAvailable = $Personne->isMailAvailable();


	//VERIFICATION DE LA VALIDITE DES INFOS ENVOYEES
	//On cree un nouvel objet regular expression
	$verifM = new Regexp($mailPersonne);
	$verifM->regexpMail(); //methode qui verifie la conformité de l'expression
	$isValidMail = $verifM->getIsValid(); // retourne un boolean True si expression ok False sinon

	$verifNom = new Regexp($nomPersonne);
	$verifNom->regexpNames();
	$isValidNom = $verifNom->getIsValid();

	$verifPrenom = new Regexp($prenomPersonne);
	$verifPrenom->regexpNames();
	$isValidPrenom = $verifPrenom->getIsValid();


	//Si infos valides et mail libre on insere une nvlle personne et sa participation.
	if ($isMailAvailable && $isValidPrenom && $isValidNom && $isValidMail ) {
    	//Méthode qui permet d'insérer une nouvelle personne en BDD
    	$Personne->setNewPersonne();
    	//Récuparation de l'id de la personne
    	$idPersonne = $Personne->getIdPersonne();

    	$returnMessage = 'Un profil a été crée. Vous utiliserez le nom et le prénom precedemment renseigné pour effectuer une nouvelle resa. <br/> ';

    	$event = new Event();

	    /* Boucle qui insert pour chaque place choisi:
	    - l'id de l'event
	    - l'id de la personne
	    - le numéro de la place
	    */
    	foreach ($tabPlacesAchetees as $numPlace) {
      		$event->insertParticipation($idEvent, $idPersonne, $numPlace);
    	}

    	$returnMessage .= 'Participation enregistrée';
    	$statut = true;


	// Si mail deja enregistré et infos valides, on vérifie que l'user a rentré les memes logs (nom/prenom) que celui stocké dans la BDD
	}else if(!$isMailAvailable && $isValidPrenom && $isValidNom && $isValidMail){
    	$statut = false;

    	$returnMessage = 'Compte existant : '.$mailPersonne.'<br />';
    	$tabLogs = $Personne->getLogs();
    	$idPersonne = $Personne->getIdPersonne();

    	$nomDb = $tabLogs['nomPersonne'];
    	$prenomDb = $tabLogs['prenomPersonne'];

    	if($nomDb === $nomPersonne && $prenomDb === $prenomPersonne){

        $event = new Event();

        foreach ($tabPlacesAchetees as $numPlace) {
            $event->insertParticipation($idEvent, $idPersonne, $numPlace);
    	}
    	$returnMessage .= 'Identifiants corrects, participation enregistrée';
    	$statut = true;

	    }else{
    	    $returnMessage .= 'Veuillez renseigner les nom/prenom utilisées lors de votre premiere reservation ';
    	}
	}else{
    	$returnMessage = 'Echec';
	}

	header('Content-type: application/json');
	echo json_encode(array('message'       => $returnMessage ,
                           'statusRequest' => $statut)) ;
}
