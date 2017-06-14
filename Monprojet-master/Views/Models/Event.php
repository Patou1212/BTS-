<?php

/**
 * Class Event
 */
class Event
{
    private $cnx;
    /**
     * Event constructor.
     */
    public function __construct()
    {
        $db = BDD::getPDOInstance();
        $this->cnx = $db->getDbh();
    }

    /**
     * Permet de récupérer la liste des events avec:
     * idEvent + titre + date + libelle
     * @return array Retourne un tableau contenant toutes les infos de l'event
     */
    /*public function getListeEvent($year)
    {
        $selectEvent = "SELECT idEvent,nbPlaceEvent,titreEvent,dateEvent,libelleType 
                        FROM event,typeevent 
                        WHERE event.idType = typeevent.idType 
                        AND dateEvent BETWEEN '$year-01-01' AND '$year-12-31' 
                        ORDER BY dateEvent,libelleType";

        $requestEvent = $this->cnx->query($selectEvent);

        $tabEvent = array();
        
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        return $tabEvent;
    }*/

    public function getListeEvent($currYear)
	{
		$s = "SELECT dateEvent,titreEvent,libelleType,idEvent,nbPlaces FROM event,typeevent,salle WHERE event.idType = 
		typeevent.idType AND event.idSalle = salle.idSalle AND dateEvent BETWEEN :date1 AND :date2";
		$val = array(":date1" => $currYear.'-01-01',
					 ":date2" => $currYear.'-12-31'
					 );
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		$tab = array();
		while($rep = $r->fetchObject())
		{
			$tab[] = $rep;
		}
		return $tab;
	}

    /**
     * Permet d'obtenir le nombre de places restantes selon un event
     * @param $idEvent Le numéro de l'id de l'event
     * @return mixed Retourne le nombre de place restantes
     */
    public function getNbPlaceRestante($idEvent)
    {
        
        //$sqlNb = "SELECT nbPlaceEvent FROM event WHERE idEvent = :idEvent";
        $sqlNb = "SELECT nbPlaces FROM salle,event WHERE salle.idSalle = event.idSalle AND idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        
        if ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) { //Si evenement
            
            $totalSeats = $repNb->nbPlaces;
            $reservedSeats = $this->getNbParticipants($idEvent);
            $leftSeats = $totalSeats - $reservedSeats;
        }else{
            $leftSeats = 0;
        }
        
        return $leftSeats;
    }

    /**
     * Permet d'insérer dans la BDD la personne qui participe à l'event
     * ainsi que le numéro des places choisi
     * @param $idEvent Le numéro de l'id de l'event
     * @param $nbPlace Le nombre de place choisi
     * @param $idPersonne Le numéro de l'id de la personne
     * @param $numPlace Array des places selectionnees
     */
    public function insertParticipation($idEvent, $idPersonne, $numPlace)
    {
            
            $sqlParticipation = "INSERT INTO participer VALUES(:idEvent,:idPersonne,:numPlace)";
            $valueParticipation = array(":idEvent"    => $idEvent,
                                        ":idPersonne" => $idPersonne,
                                        ":numPlace"   => $numPlace
                                        );
            
            $reqParticipation = $this->cnx->prepare($sqlParticipation);
            $reqParticipation->execute($valueParticipation); 
            

    }

    /**
     * Permet de mettre à jour le nombre de place disponibles après une réservation
     * @param $nbPlace Le nombre de place choisi
     * @param $idEvent Le numéro de l'id de l'event
     * @param $nbPlaceRestanteAvant Le nombre de place disponible avant réservation
     */
    public function updateNbPlaceEvent($nbPlace, $idEvent, $nbPlaceRestanteAvant)
    {

        $nbPlaceRestanteApres = $nbPlaceRestanteAvant - $nbPlace;
        $sqlUpdate = "UPDATE event SET nbPlaceEventRestante = :nbPlace WHERE idEvent = :idEvent";
        $valUpdate = array(":nbPlace" => $nbPlaceRestanteApres,
                           ":idEvent" => $idEvent
        );
        $reqUpdate = $this->cnx->prepare($sqlUpdate);
        $reqUpdate->execute($valUpdate);
    }

    /**
     * Permet d'obtenir la liste des events de la BDD en format JSON
     * pour les requêtes AJAX
     */
    public function getListeEventJson()
    {
        $selectEvent = "SELECT dateEvent,titreEvent,libelleType,idEvent FROM event,typeevent 
        WHERE event.idType = typeevent.idType ORDER BY dateEvent,libelleType";
        $requestEvent = $this->cnx->query($selectEvent);
        $tabEvent = array();
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        echo json_encode($tabEvent, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Permet d'obtenir le nombre de places restantes d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceRestanteJson($idEvent)
    {
        $sqlNb = "SELECT nbPlaces 
                  FROM salle,event
                  WHERE idEvent = :idEvent
                  AND salle.idSalle = event.idSalle";

        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);

        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlace['placeEvent'] = $repNb->nbPlaces;
        }

        echo json_encode($nbrePlace, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Permet d'obtenir le nombre de places réservées d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceReserveJson($idEvent)
    {
        $sqlNb = "SELECT numPlace FROM participer WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        $i = 0;
        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlaceReserve['placeReserveEvent'][$i] = $repNb->numPlace;
            $i++;
        }

        echo json_encode($nbrePlaceReserve, JSON_NUMERIC_CHECK);
    }

    public function insertNewEvent($titre, $date, $type, $salle, $path = null)
    {

        $returnMessage = '';
        
        // On verifie qu'un evenemenet n'existe pas a la date rentrée par l'user
        $requestDateFree = "SELECT titreEvent FROM event WHERE dateEvent = :dateEventUser";
        
        $ret = $this->cnx->prepare($requestDateFree);
        $ret->bindParam(':dateEventUser', $date);
        $ret->execute();
                
        if ($ret->rowCount() > 0 ){
           $returnMessage = 'Evènement déjà existant';
           
        }else{
        //Si la date entrée par l'utilisateur comme jour d'event n'est pas dans la base on insert l'event
      
            $paramsEvent = array(':titre'    => $titre,
                                 ':dateE'    => $date,
                                 ':salle'    => $salle,
                                 ':type'     => $type,
                                 ':pathImg'  => $path
            );

            $r = 'INSERT INTO event( titreEvent, dateEvent,idType,path,idSalle)
                  VALUES (:titre,:dateE,:type,:pathImg,:salle)';

            $ret = $this->cnx->prepare($r);
            $ret->execute($paramsEvent);

            if($ret->rowCount() > 0 ){
                $returnMessage = "L'évènement a été ajouté avec succès";
            }else{
                $returnMessage ="Echec requête";
            }
        }
        return $returnMessage;

    }

    public function getInfosEvent($idEvent)
    {
    	$r = "SELECT titreEvent,dateEvent,libelleType,nbPlaces,salle.idSalle
    		  FROM event,typeevent,salle
    		  WHERE idEvent = :idEvent
              AND event.idSalle = salle.idSalle
    		  AND event.idType = typeevent.idType";

        $ret = $this->cnx->prepare($r);
        $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $ret->execute();
        $tab = [];

        if ($o = $ret->fetch()){
            
            $nbParticipants = $this->getNbParticipants($idEvent);
            $tab['idSalle']       = $o->idSalle;
            $tab['titreEvent']    = $o->titreEvent;
            $tab['dateEvent']     = $o->dateEvent;
            $tab['typeEvent']     = $o->libelleType;
            $tab['nbPlaceEventRestante']  = $o->nbPlaces - $nbParticipants;
        }

        return $tab;
    }


    public function getNbParticipants($idEvent){
    	$nbParticipants = 0;

        $sqlNbParticipants = "SELECT COUNT(numPlace) AS nbParticipants
              FROM participer
              WHERE idEvent = :idEvent";

        $ret = $this->cnx->prepare($sqlNbParticipants);
        $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $ret->execute();

        if ($o = $ret->fetch()){
            $nbParticipants = $o->nbParticipants;
        }
        return $nbParticipants;
    }

     public function getIdEvent($dateEvent)
    {
        $s = "SELECT idEvent FROM event WHERE dateEvent = :dateEvent";
        $val = array("dateEvent" => $dateEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idEvent;
        }
    }
    public function getIdSalle($dateEvent)
    {
        $s = "SELECT idSalle FROM event WHERE dateEvent = :dateEvent";
        $val = array("dateEvent" => $dateEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idSalle;
        }
    }
    public function getNbPlaces($idSalle)
    {
        $s = "SELECT nbPlaces FROM salle WHERE idSalle = :idSalle";
        $val = array("idSalle" => $idSalle);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->nbPlaces;
        }
    }

    public function getTitreEvent($idEvent)
    {
        $s = "SELECT titreEvent FROM event WHERE idEvent = :idEvent";
        $val = array("idEvent" => $idEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->titreEvent;
        }
    }
    public function getTitreEventByDate($dateEvent)
	{
		$s = "SELECT titreEvent FROM event WHERE dateEvent = :dateEvent";
		$val = array(':dateEvent' => $dateEvent);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		while($rep = $r->fetchObject())
		{
			return $rep->titreEvent;
		}
	}
    // public function getPlacesReservees($idEvent){

    //     $tabPlacesReservees = [];

    //     $r = "SELECT numPlace
    //           FROM participer
    //           WHERE idEvent = :idEvent
    //           ";

    //     $ret = $this->cnx->prepare($r);
    //     $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
    //     $ret->execute();

    //     while ($o = $ret->fetch()){
    //         $tabPlacesReservees[] = $o->numPlace;
    //     }
    //     return  $tabPlacesReservees;

    // }

    public function getTypesEvent(){

    	$selectTypes = "SELECT idType, libelleType
    					FROM typeevent
    					";

    	$request = $this->cnx->query($selectTypes);

        $tabTypeEvent = array();

        while ($repEvent = $request->fetchObject())
        {
            $tabTypeEvent[] = $repEvent;
        }
        return $tabTypeEvent;
    }


    public function getSalles(){

        $selectSalles = "SELECT idSalle,nomSalle,nbPlaces
                        FROM salle
                        ";

        $request = $this->cnx->query($selectSalles);

        $tabSalles = array();

        while ($repEvent = $request->fetchObject())
        {
            $tabSalles[] = $repEvent;
        }
        return $tabSalles;
    }

    /**
     * Permet d'obtenir le nombre de places restantes d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceJson($idEvent)
    {
        $sqlNb = "SELECT nbPlaceEvent FROM event WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlace['placeEvent'] = $repNb->nbPlaceEvent;
        }

        echo json_encode($nbrePlace, JSON_UNESCAPED_UNICODE);
    }

    public function getNbPlaceAchete($dateEvent)
	{
		$s = "SELECT count(participer.idPersonne) as nbParticipant FROM participer,event WHERE event.idEvent = participer.idEvent AND dateEvent = :dateEvent";
		$val = array(':dateEvent' => $dateEvent);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		while($rep = $r->fetchObject())
		{
			return $rep->nbParticipant;
		}
	}

	public function affichePersonneEvent($dateEvent)
	{
		$s = "SELECT nomPersonne,PrenomPersonne,mailPersonne,participer.idPersonne,count(numPlace) as nbPlaceAchete
			  FROM event,participer,personne 
			  WHERE participer.idEvent = event.idEvent
			  AND participer.idPersonne = personne.idPersonne 
			  AND dateEvent = :dateEvent 
			  GROUP BY nomPersonne,PrenomPersonne,mailPersonne,participer.idPersonne";
		$val = array(':dateEvent' => $dateEvent);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		$tab = array();
		while($rep = $r->fetchObject())
		{
			$tab[] = $rep;
		}
		return $tab;
	}

	public function supprimeParticipant($dateEvent,$idPersonne)
	{
		$idEvent = $this->getIdEvent($dateEvent);
		$s = "DELETE FROM participer WHERE idEvent = :idEvent AND idPersonne = :idPersonne";
		$val = array(':idEvent'    => $idEvent,
					 ':idPersonne' => $idPersonne
					 );
		$r = $this->cnx->prepare($s);
		$r->execute($val);
	}

	public function getPath($dateEvent)
    {
        $s = "SELECT path FROM event WHERE dateEvent = :dateEvent";
        $val = array("dateEvent" => $dateEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->path;
        }
    }

}