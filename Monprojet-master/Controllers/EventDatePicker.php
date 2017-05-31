<?php
/**
 * Model EventDatePicker.php
 * Permet d'obtenir la liste des events de la BDD en format JSON
 * pour les requêtes AJAX
 */
//Autoloader permettant de charger les classes automatiquement
require '../Autoloader.php';
Autoloader::register();
$Events = new Event();
$tabEvent = $Events->getListeEventJson();

//On force le format JSON
header('Content-type: application/json');
echo $tabEvent;
