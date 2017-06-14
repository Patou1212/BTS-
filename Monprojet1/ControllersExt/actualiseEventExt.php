<?php
session_start();
require '../Autoloader.php';
Autoloader::register();

        if(isset($_POST['ValiderEventExt'], $_POST['datePicked'])){

            //On recupere l'id de l'event grace à la date envoyée.
            //Il servira a la requete d'insert ajax effectuée sur EventSelectedSeatPicker-Front.php
            
           $eventExt = new Event();
           $idEvent = $eventExt->getIdEvent($_POST['datePicked']);
           $idSalle = $eventExt->getIdSalle($_POST['datePicked']);
           $nbPlacesSalle = $eventExt->getNbPlaces($idSalle);
           $dataEvent = json_encode(array( "idEvent" => $idEvent, "idSalle" => $idSalle, "nbPlacesSalle" => $nbPlacesSalle));
           $_SESSION['idEvent'] = $idEvent;
           $_SESSION['dataEvent'] = $dataEvent;
           include "../ViewsExt/InscriptionEvenementClientExt.php";
        }else{
            header( "Location:ListeEventClientExt.php" ); 
        }
 ?>