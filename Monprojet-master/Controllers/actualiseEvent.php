<?php
session_start();
require '../Autoloader.php';
Autoloader::register();

        if(isset($_POST['ValiderEvent'], $_POST['datePicked'])){

            //On recupere l'id de l'event grace à la date envoyée.
            //Il servira a la requete d'insert ajax effectuée sur EventSelectedSeatPicker-Front.php
            
           $event = new Event();
           $idEvent = $event->getIdEvent($_POST['datePicked']);
           $idSalle = $event->getIdSalle($_POST['datePicked']);
           $nbPlacesSalle = $event->getNbPlaces($idSalle);
           $dataEvent = json_encode(array( "idEvent" => $idEvent, "idSalle" => $idSalle, "nbPlacesSalle" => $nbPlacesSalle));
           $_SESSION['idEvent'] = $idEvent;
           $_SESSION['dataEvent'] = $dataEvent;
           include "../Views/InscriptionEvenementClient.php";
        }else{
            header( "Location:ListeEventClient.php" ); 
        }
 ?>