<?php
require '../Autoloader.php';
Autoloader::register();

$Events = new Event();
$currYear = date('Y');


$tabEvent = $Events->getListeEvent($currYear);
$listeEvent = '';
foreach ($tabEvent as $event) {
    $listeEvent .= '<option value=' . $event->idEvent . '>' . $event->titreEvent . '  --  ' . $event->libelleType . '  --  ' .$event->dateEvent. '</option>';
}


include '../Views/ListeEvenement.php';