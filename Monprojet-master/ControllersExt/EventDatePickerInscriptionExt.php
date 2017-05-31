<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Autoloader.php';
Autoloader::register();

if(isset($_GET["dataSent"]))
{
	$Events = $Events = new Event();
	$tabEventExt = $Events->getListeEvent($_GET["dataSentExt"]);
	$jsonDate = array();
	foreach ($tabEventExt as $eventExt) {
        $nbPlaceRestante = $Events->getNbPlaceRestante($eventExt->idEventExt);
    	$jsonDate[] = array("dateEvenExt" => $eventExt->dateEventExt , 'titreEventExt' => $eventExt->titreEventExt , 'nbPlaceEventExt' => $nbPlaceRestanteExt, 'libelleTypeExt' => $eventExt->libelleTypeExt);
	}
	echo json_encode($jsonDate);
}

/*if(isset($_GET["dateChoisie"]))
{
    $dateEvent = $_GET['dateChoisie'];
    $event = new Event();
    $idEvent = $event->getIdEvent($dateEvent);
    $titreEvent = $event->getTitreEvent($idEvent);
    $nbPlaceRestante = $event->getNbPlaceRestante($idEvent);
    $option = "<option value='0'>Choix Place</option>";
    for ($i = 1; $i <= $nbPlaceRestante; $i++) {
        $option .= '<option value=' . $i . '>' . $i . '</option>';
    }
    $_SESSION['idEvent'] = $idEvent;
    $_SESSION['titreEvent'] = $titreEvent;
    $_SESSION['dateEvent'] = $dateEvent;
    include "../Views/InscriptionEvenementClient.php";
}*/

