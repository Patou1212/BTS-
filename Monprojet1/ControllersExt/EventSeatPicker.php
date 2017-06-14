<?php
/**
 * Model EventSeatPicker.php
 * Permet d'obtenir le nombre de places restantes d'un event en format JSON
 * pour les requêtes AJAX
 */
//Démarre une nouvelle session ou reprend une session existante
session_start();
//Autoloader permettant de charger les classes automatiquement
require '../Autoloader.php';
Autoloader::register();
$Events = new Event();
$nbrePlaceEvent = $Events->getNbPlaceRestanteJson($_SESSION['idEvent']);

//On force le format JSON
header('Content-type: application/json');
echo $nbrePlaceEvent;
