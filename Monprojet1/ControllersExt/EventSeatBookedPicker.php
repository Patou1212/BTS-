<?php
/**
 * Model EventSeatBookedPicker.php
 * Permet d'obtenir le nombre de places réservées d'un event en format JSON
 * pour les requêtes AJAX
 */
//Démarre une nouvelle session ou reprend une session existante
session_start();
//Autoloader permettant de charger les classes automatiquement
require '../Autoloader.php';
Autoloader::register();
$Events = new Event();
$nbrePlaceReserve = $Events->getNbPlaceReserveJson($_SESSION['idEvent']);

//On force le format JSON
header('Content-type: application/json');
echo $nbrePlaceReserve;
