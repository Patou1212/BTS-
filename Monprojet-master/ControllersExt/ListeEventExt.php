<?php
require '../Autoloader.php';
Autoloader::register();

$Events = new EventExt();
$currYear = date('Y');


$tabEventExt = $Events->getListeEvent($currYear);
$listeEventExt = '';
foreach ($tabEventExt as $eventExt) {
    $listeEventExt .= '<option value=' . $eventExt->idEvent . '>' . $eventExt->titreEvent . '  --  ' . $eventExt->libelleType . '  --  ' .$eventExt->dateEvent. '</option>';
}


include '../ViewsExt/ListeEvenementExt.php';