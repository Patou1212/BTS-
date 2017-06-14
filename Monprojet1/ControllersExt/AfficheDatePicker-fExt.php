<?php
/**
 * Controller AfficheDatePicker-f.php
 * Permet de récupérer le path de l'image pour
 * la requête json du fichier date.js
 * /

 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../Autoloader.php';
Autoloader::register();

//si on reçoit la date depuis date.js
if(isset($_GET["dataSent"]))
{
    //création de l'objet $Events
	$Events = new Event();
    //set variable avec le path de l'image depuis la BDD
	$tabEventExt = $Events->getPath($_GET["dataSent"]);
    //set variable pour le format json
	$jsonDate = array("afficheEvent" => $tabEventExt);
    //encodage au format json
	echo json_encode($jsonDate);
}