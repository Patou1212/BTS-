<?php
session_start();
require '../Autoloader.php';
Autoloader::register();
if (isset($_GET['dateChoisie'])) {
    $_SESSION['dateEvent'] = $_GET['dateChoisie'];
    $event = new Event();
    $tabPersonne = $event->affichePersonneEvent($_GET['dateChoisie']);
    $jsonPersonne = array();
    $tableauHTML = array();
    $titreEvent = $event->getTitreEventByDate($_GET['dateChoisie']);
    $i = 0;
    foreach ($tabPersonne as $personne) {
        $tableauHTML[] = "<tr id='tr$i'>
							  <td>$personne->nomPersonne</td>
							  <td>$personne->PrenomPersonne</td>
							  <td>$personne->mailPersonne</td>
							  <td>$personne->nbPlaceAchete</td>
							  <td><p data-placement='top' data-toggle='tooltip' title='Supprimer'><button id='idPersonne$i' value='$personne->idPersonne' class='btn btn-danger btn - xs' data-title='Supprimer'><span class='glyphicon glyphicon-trash'></span></button></p></td>
	   					  </tr>";
        $i++;
    }
    $imax = $i;
    $jsonPersonne['imax'] = $imax;
    $jsonPersonne['personne'] = $tableauHTML;
    $jsonPersonne['titreEvent'] = $titreEvent;
    echo json_encode($jsonPersonne);
}
if (isset($_GET['idPersonne'])) {
    $event = new Event();
    $idPersonne = $_GET['idPersonne'];
    $event->supprimeParticipant($_SESSION['dateEvent'], $idPersonne);
}

?>