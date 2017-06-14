<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../Autoloader.php';
Autoloader::register();
$currYear = date('Y');

$Events = new Event();
$tabEventExt = $Events->getListeEvent($currYear);


$jsonDate = array();
foreach ($tabEventExt as $eventExt) {
	$nbPlaceRestante = $Events->getNbPlaceRestante($eventExt->idEventExt);
    $jsonDate[] = array("dateEventExt" => $eventExt->dateEventExt , 'titreEventExt' => $eventExt->titreEventExt , 'nbPlaceEventExt' => $nbPlaceRestanteExt, 'libelleTypeExt' => $eventExt->libelleTypeExt);
}
echo json_encode($jsonDate);