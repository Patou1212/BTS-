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
		$s = "SELECT dateEventExt,titreEventExt,libelleTypeExt,idEventExt,adrLieu FROM eventExt,typeeventExt,lieu WHERE eventExt.idTypeExt = 
		typeeventExt.idTypeExt AND eventExt.idLieu = lieu.idLieu AND dateEventExt BETWEEN :date1 AND :date2";
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
        
        //$sqlNb = "SELECT adrLieu FROM event WHERE idEvent = :idEvent";
        $sqlNb = "SELECT adrLieu FROM lieu,eventExt WHERE lieu.idLieu = eventExt.idLieu AND idEventExt = :idEventExt";
        $valNb = array("idEventExt" => $idEventExt);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        
        if ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) { //Si evenement
            
            $totalSeats = $repNb->adrLieu;
            $reservedSeats = $this->getNbParticipants($idEventExt);
            $leftSeats = $totalSeats - $reservedSeats;
        }else{
            $leftSeats = 0;
        }
        
        return $leftSeats;
    }

    public function getListeEventJson()
    {
        $selectEvent = "SELECT dateEventExt,titreEventExt,libelleTypeExt,idEventExt FROM eventExt,typeeventExt 
        WHERE eventExt.idTypeExt = typeeventExt.idTypeExt ORDER BY dateEventExt,libelleTypeExt ";
        $requestEvent = $this->cnx->query($selectEvent);
        $tabEvent = array();
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        echo json_encode($tabEvent, JSON_UNESCAPED_UNICODE);
    }

    public function insertNewEvent($titre, $date, $type, $salle)
    {

        $returnMessage = '';
        
        // On verifie qu'un evenemenet n'existe pas a la date rentrée par l'user
        $requestDateFree = "SELECT titreEventExt FROM eventExt WHERE dateEventExt = :dateEventUser";
        
        $ret = $this->cnx->prepare($requestDateFree);
        $ret->bindParam(':dateEventUser', $date);
        $ret->execute();
                
        if ($ret->rowCount() > 0 ){
           $returnMessage = 'Evènement déjà existant';
           
        }else{
        //Si la date entrée par l'utilisateur comme jour d'event n'est pas dans la base on insert l'event
      
            $paramsEvent = array(':titreEventExt'    => $titre,
                                 ':dateEventExt'    => $date,
                                 ':idlieuExt'    => $lieu,
                                 ':idTypeExt'     => $type
            );

            $r = 'INSERT INTO eventExt( titreEventExt, dateEventExt,idTypeExt,idlieuExt)
                  VALUES (:titreEventExt,:dateEventExt,:idTypeExt,:idlieuExt)';

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
    	$r = "SELECT titreEventExt,dateEventExt,libelleTypeExt,adrLieu
    		  FROM eventExt,typeeventExt,lieu
    		  WHERE idEventExt = :idEventExt
              AND eventExt.idLieu = lieu.idLieu
    		  AND eventExt.idTypeExt = typeeventExt.idTypeExt";

        $ret = $this->cnx->prepare($r);
        $ret->bindParam(':idEvent', $idEventExt, PDO::PARAM_INT);
        $ret->execute();
        $tab = [];

        if ($o = $ret->fetch()){
            
            $nbParticipants = $this->getNbParticipants($idEventExt);
            $tab['idLieu']       = $o->idLieu;
            $tab['titreEventExt']    = $o->titreEventExt;
            $tab['dateEventExt']     = $o->dateEventExt;
            $tab['typeEventExt']     = $o->libelleTypeExt;
        }

        return $tab;
    }


    public function getNbParticipants($idEventExt){
    	$nbParticipants = 0;

        $sqlNbParticipants = "SELECT COUNT(numPlace) AS nbParticipants
              FROM participer
              WHERE idEventExt = :idEventExt";

        $ret = $this->cnx->prepare($sqlNbParticipants);
        $ret->bindParam(':idEventExt', $idEventExt, PDO::PARAM_INT);
        $ret->execute();

        if ($o = $ret->fetch()){
            $nbParticipants = $o->nbParticipants;
        }
        return $nbParticipants;
    }

     public function getIdEventExt($dateEventExt)
    {
        $s = "SELECT idEventExt FROM eventExt WHERE dateEventExt = :dateEventExt";
        $val = array("dateEventExt" => $dateEventExt);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idEvent;
        }
    }
    public function getIdLieu($dateEventExt)
    {
        $s = "SELECT idlieu FROM eventExt WHERE dateEventExt = :dateEventExt";
        $val = array("dateEventExt" => $dateEventExt);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idLieu;
        }
    }
    public function getadrLieu($idLieu)
    {
        $s = "SELECT adrLieu FROM Lieu WHERE idLieu = :idLieu";
        $val = array("idLieu" => $idLieu);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->adrlieu;
        }
    }

    public function getTitreEventExt($idEventExt)
    {
        $s = "SELECT titreEventext FROM eventExt WHERE idEventExt = :idEventExt";
        $val = array("idEventExt" => $idEventExt);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->titreEventExt;
        }
    }
    public function getTitreEventExtByDate($dateEventExt)
	{
		$s = "SELECT titreEventExt FROM eventExt WHERE dateEventExt = :dateEventExt";
		$val = array(':dateEventExt' => $dateEventExt);
		$r = $this->cnx->prepare($s);
		$r->execute($val);
		while($rep = $r->fetchObject())
		{
			return $rep->titreEventExt;
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

    public function getTypesEventExt(){

    	$selectTypes = "SELECT idTypeExt, libelleTypeExt
    					FROM typeeventExt
    					";

    	$request = $this->cnx->query($selectTypes);

        $tabTypeEvent = array();

        while ($repEvent = $request->fetchObject())
        {
            $tabTypeEvent[] = $repEvent;
        }
        return $tabTypeEvent;
    }


    public function getlieu(){

        $selectSalles = "SELECT idLieu,adrLieu,superficieLieu,nomLieu
                        FROM lieu
                        ";

        $request = $this->cnx->query($selectSalles);

        $tabSalles = array();

        while ($repEvent = $request->fetchObject())
        {
            $tabSalles[] = $repEvent;
        }
        return $tabSalles;
    }

  

	public function affichePersonneEventExt($dateEventExt)
	{
		$s = "SELECT nom_cli,Prenom_cli,email_Cli,demander.id_Cli,count(adrLieu) as nbPlaceAchete
			  FROM eventExt,demander,client
			  WHERE demander.idEventExt = eventExt.idEventExt
			  AND demander.id_Cli = client.id_Cli 
			  AND dateEventExt = :dateEventExt 
			  GROUP BY nom_cli,Prenom_cli,email_Cli,demander.id_Cli";
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

	public function supprimeClient($dateEventExt,$id_Cli)
	{
		$idEvent = $this->getIdEvent($dateEvent);
		$s = "DELETE FROM participer WHERE idEvent = :idEvent AND idPersonne = :idPersonne";
		$val = array(':idEvent'    => $idEvent,
					 ':idPersonne' => $idPersonne
					 );
		$r = $this->cnx->prepare($s);
		$r->execute($val);
	}
    }

}