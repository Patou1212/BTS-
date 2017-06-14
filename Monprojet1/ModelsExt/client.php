<?php

/**
 * Class Personne
 */
class Client
{
    /**
     * @var PDO
     */
    private $cnx;
    /**
     * @var $nom du client
     */
    private $Nom_Cli;

    /**
     * @var $Prenom du client
     */
    private $Prenom_Cli;
    /**
     * @var $email du client
     */
    private $email_Cli;
    /**
     * @var $sexe du client
     */
    private $Sexe_Cli;
    /**
     * @var $Age du client
     */
    private $Age_Cli;
    /**
     * @var $Demande du client
     */
    private $Demande_Cli;

    /**
     * Client constructor.
     * @param $Nom client
     * @param $Prenom client  
     * @param $Email client   
     * @param $Sexe client  
     * @param $Age client  
     * @param $Demande du client  
     */
    public function __construct($Nom_Cli, $Prenom_Cli, $email_Cli, $Sexe_Cli, $Age_Cli, $Demande_Cli )
    {
        $db = BDD::getPDOInstance();
        $this->cnx = $db->getDbh();
        $this->Nom_Cli = $Nom_Cli;
        $this->Prenom_Cli = $Prenom_Cli;
        $this->email_Cli = $email_Cli;
        $this->Sexe_Cli = $Sexe_Cli;
        $this->Age_Cli = $Age_Cli;
        $this->Demande_Cli = $Demande_Cli;
    }


    /**
     * Method qui insere la personne dans la BDD
     * @return boolean
     */
    public function setNewClient()
    {
       /* $sql = "SELECT * FROM personne WHERE mailPersonne = :mailPersonne";
        $value = array(":mailPersonne" => $this->mailPersonne);
        $req = $this->cnx->prepare($sql);
        $req->execute($value);
        
        var_dump($req->rowCount());
        if ($req->rowCount() == 0) {
        */

            $sqlInsert = "INSERT INTO client VALUES('',:Nom_Cli,:Prenom_Cli,:email_Cli,:Sexe_Cli, ,:Age_Cli, ,:Demande_Cli)";
            $valInsert = array(":Nom_Cli"    => $this->Nom_Cli,
                               ":Prenom_Cli" => $this->Prenom_Cli,
                               ":email_Cli" => $this->email_Cli,
                               ":Sexe_Cli"   => $this->Sexe_Cli);
                               ":Age_Cli"   => $this->Age_Cli);
                               ":Demande_Cli"   => $this->Demande_Cli)
            $reqInsert = $this->cnx->prepare($sqlInsert);
            $reqInsert->execute($valInsert);

        //}
    }
     /**
     * REcuperation des logs d'une personne
     */

     public function getLogs(){
         $email_Cli = $this->email_Cli;

         $sql = " SELECT Nom_Cli, Prenom_Cli FROM client WHERE email_Cli = :mailUser";

         $reqnb = $this->cnx->prepare($sql);
         $reqnb->bindParam(':mailUser',$mailUser,PDO::PARAM_STR);
         $reqnb->execute();

         $tab = [];
         if ($res = $reqnb->fetch(PDO::FETCH_OBJ) ){
             $tab['Nom_Cli'] = $res->Nom_Cli;
             $tab['Prenom_Cli'] = $res->Prenom_Cli;
         }
         return $tab;

     }

     /**
     * Méthode qui contrôle si la personne existe
     */
    public function isMailAvailable(){
        
        $mailUser = $this->email_Cli; 
            
        $sqlNb = "SELECT * FROM client WHERE email_Cli = :mailUser";
        
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
    public function getIdClient()
    {
        $selectId = "SELECT id_Cli FROM client WHERE email_Cli = :mail";
        $value = array(":mail" => $this->email_Cli);
        $requestId = $this->cnx->prepare($selectId);
        $requestId->execute($value);
        while ($repid = $requestId->fetch(PDO::FETCH_OBJ)) {
            $id_Cli = $repid->id_Cli;
        }

        return $id_Cli;
    }
}