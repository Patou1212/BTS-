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

    public function getListeEvent1($currYear)
	{
		$s = "SELECT dateEventExt,titreEventExt,idEventExt,adresse FROM eventExt WHERE dateEventExt BETWEEN :date1 AND :date2";
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
     * Permet d'obtenir la liste des events de la BDD en format JSON
     * pour les requêtes AJAX
     */
    public function getListeEventJson()
    {
        $selectEvent = "SELECT dateEventExt,titreEventExt,adresse,idEventExt FROM eventExt  ORDER BY dateEventExt";
        $requestEvent = $this->cnx->query($selectEvent);
        $tabEvent = array();
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        echo json_encode($tabEvent, JSON_UNESCAPED_UNICODE);
    }


   

    public function insertNewEventext($NomEventext, $date, $Adresse,$ville, $cp)
    {

        $returnMessage = '';
        
        // On verifie qu'un evenemenet n'existe pas a la date rentrée par l'user
        $requestDateFree = "SELECT titreEventExt FROM eventext WHERE dateEventext = :dateEventUser";
        
        $ret = $this->cnx->prepare($requestDateFree);
        $ret->bindParam(':dateEventUser', $date);
        $ret->execute();
                
        if ($ret->rowCount() > 0 ){
           $returnMessage = 'Evènement déjà existant';
           
        }else{
        //Si la date entrée par l'utilisateur comme jour d'event n'est pas dans la base on insert l'event
      
            $paramsEvent = array(':titeEventExt'    => $titeEventExtt,
                                 ':dateEventext'    => $date,
                                 ':adresse'    => $Adresse,
                                 ':ville'     => $ville
            );

            $r = 'INSERT INTO eventext( titeEventExt, dateEventext ,Adresse, ville,cp)
                  VALUES (:titeEventExt,:dateEventext,:Adresse,:ville, :cp)';

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

    public function getInfosEvent($idEventExt)
    {
    	$r = "SELECT titreEventExt,dateEventExt,idPersonne
    		  FROM eventExt, personne
    		  WHERE idEventExt = :idEventExt
              AND eventExt.idPersonne= personne.idPersonne";

        $ret = $this->cnx->prepare($r);
        $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $ret->execute();
        $tab = [];

        if ($o = $ret->fetch()){
            
            $nbParticipants = $this->getNbParticipants($idEventExt);
            $tab['titreEventExt']    = $o->titreEventExt;
            $tab['dateEventExt']     = $o->dateEventExt;
            $tab['adresse']     = $o->adresse;
         
        }

        return $tab;
    }



     public function getIdEvent($dateEventExt)
    {
        $s = "SELECT idEventExt FROM eventExt WHERE dateEventExt = :dateEventEwt";
        $val = array("dateEventExt" => $dateEventExt);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idEventExt;
        }
    }
  
    

    public function getTitreEvent($idEventExt)
    {
        $s = "SELECT titreEventExt FROM eventExt WHERE idEventExt = :idEventExt";
        $val = array("idEvenExtt" => $idEventExt);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->titreEventExt;
        }
    }
    public function getTitreEventByDate($dateEventExt)
	{
		$s = "SELECT titreEventExt FROM eventExt WHERE dateEventExt = :dateEventExt";
		$val = array(':dateEventExt' => $dateEventExt);
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





    public function getNbPlaceAchete($dateEventExt)
	{
		$s = "SELECT count(participer.idPersonne) as nbParticipant FROM participer,eventExt WHERE eventExt.idEventExt = participer.idEventExt AND dateEventExt = :dateEventExt";
		$val = array(':dateEventExt' => $dateEventExt);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		while($rep = $r->fetchObject())
		{
			return $rep->nbParticipant;
		}
	}

	public function affichePersonneEventExt($dateEvent)
	{
		$s = "SELECT nomPersonne,PrenomPersonne,mailPersonne,participer.idPersonne
			  WHERE participer.idEventExt = eventExt.idEventExt
			  AND participer.idPersonne = personne.idPersonne 
			  AND dateEventExt = :dateEventExt 
			  GROUP BY nomPersonne,PrenomPersonne,mailPersonne,participer.idPersonne";
		$val = array(':dateEventExt' => $dateEventExt);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		$tab = array();
		while($rep = $r->fetchObject())
		{
			$tab[] = $rep;
		}
		return $tab;
	}

	public function supprimeParticipant($dateEventExt,$idPersonne)
	{
		$idEventExt = $this->getIdEvent($dateEventExt);
		$s = "DELETE FROM participer WHERE idEventExt = :idEventExt AND idPersonne = :idPersonne";
		$val = array(':idEventExt'    => $idEventExt,
					 ':idPersonne' => $idPersonne
					 );
		$r = $this->cnx->prepare($s);
		$r->execute($val);
	}

	

}