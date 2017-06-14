<?php

/**
 * Class Personne
 */
class Personne
{
    /**
     * @var PDO
     */
    private $cnx;
    /**
     * @var $mailPersonne Mail de la personne
     */
    private $mailPersonne;
    /**
     * @var $nomPersonne Nom de la personne
     */
    private $nomPersonne;
    /**
     * @var $prenomPersonne Prénom de la personne
     */
    private $prenomPersonne;
    

    /**
     * Personne constructor.
     * @param $mailPersonne Mail de la personne
     * @param $nomPersonne Nom de la personne
     * @param $prenomPersonne Prénom de la personne
     */
    public function __construct($mailPersonne, $nomPersonne, $prenomPersonne)
    {
        $db = BDD::getPDOInstance();
        $this->cnx = $db->getDbh();

        $this->mailPersonne = $mailPersonne;
        $this->nomPersonne = $nomPersonne;
        $this->prenomPersonne = $prenomPersonne;
    }


    /**
     * Method qui insere la personne dans la BDD
     * @return boolean
     */
    public function setNewPersonne()
    {
       /* $sql = "SELECT * FROM personne WHERE mailPersonne = :mailPersonne";
        $value = array(":mailPersonne" => $this->mailPersonne);
        $req = $this->cnx->prepare($sql);
        $req->execute($value);
        
        var_dump($req->rowCount());
        if ($req->rowCount() == 0) {
        */

            $sqlInsert = "INSERT INTO personne VALUES('',:nomPersonne,:prenomPersonne,:mailPersonne)";
            $valInsert = array(":nomPersonne"    => $this->nomPersonne,
                               ":prenomPersonne" => $this->prenomPersonne,
                               ":mailPersonne"   => $this->mailPersonne);
            $reqInsert = $this->cnx->prepare($sqlInsert);
            $reqInsert->execute($valInsert);

        //}
    }
     /**
     * REcuperation des logs d'une personne
     */

     public function getLogs(){
         $mailUser = $this->mailPersonne;

         $sql = " SELECT nomPersonne, PrenomPersonne FROM personne WHERE mailPersonne = :mailUser";

         $reqnb = $this->cnx->prepare($sql);
         $reqnb->bindParam(':mailUser',$mailUser,PDO::PARAM_STR);
         $reqnb->execute();

         $tab = [];
         if ($res = $reqnb->fetch(PDO::FETCH_OBJ) ){
             $tab['nomPersonne'] = $res->nomPersonne;
             $tab['prenomPersonne'] = $res->PrenomPersonne;
         }
         return $tab;

     }

     /**
     * Méthode qui contrôle si la personne existe
     */
    public function isMailAvailable(){
        
        $mailUser = $this->mailPersonne; 
            
        $sqlNb = "SELECT * FROM personne WHERE mailPersonne = :mailUser";
        
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->bindParam(':mailUser', $mailUser, PDO::PARAM_STR);
        $reqNb->execute();
        
        if($reqNb->rowCount() > 0 ){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Méthode qui permet de récupérer l'id d'une personne
     * à partir de son adresse mail
     * @return mixed Retourne l'id de la personne
     */
    public function getIdPersonne()
    {
        $selectId = "SELECT idPersonne FROM personne WHERE mailPersonne = :mail";
        $value = array(":mail" => $this->mailPersonne);
        $requestId = $this->cnx->prepare($selectId);
        $requestId->execute($value);
        while ($repid = $requestId->fetch(PDO::FETCH_OBJ)) {
            $idPersonne = $repid->idPersonne;
        }

        return $idPersonne;
    }
}