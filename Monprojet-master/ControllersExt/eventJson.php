<?php

session_start();
require '../Autoloader.php';
Autoloader::register();
if(isset($_GET['dataSent']))
{
	$currYear = $_GET['dataSent'];
	
}
else
{
	$currYear = date('Y');
}
	$events = new Event();
	$tabEvent = $events->getListeEvent($currYear);
	$jsonDate = array();
	foreach ($tabEvent as $event) {
		$nbParticipant = $events->getNbPlaceAchete($event->dateEvent);
	    $jsonDate[] = array("dateEvent" => $event->dateEvent , 'titreEvent' => $event->titreEvent, 'libelleType' => $event->libelleType, 'nbPlaceEvent' => $event->nbPlaces, 'nbParticipant' => $nbParticipant);
	}
	echo json_encode($jsonDate);

?>