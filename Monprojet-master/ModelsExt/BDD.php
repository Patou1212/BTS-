<?php

/**
 * Description of BDD
 * Le Singleton, permet d'avoir une classe qui sera instanciée qu'une seule fois tout au long de notre application. Par exemple, dans le cadre de notre
 * application nous auront une seule et unique configuration. On va donc chercher à instancier cette objet une seule fois pour pouvoir ensuite récupérer
 * l'instance à tout moment de notre application.
 */

/**
 * Class BDD
 */
class BDD
{

    /**
     * @var null instance PDO
     */
    private static $instance = null;
    /**
     * @var PDO
     */
    private $dbh;

    /**
     * @const PARAM_host Nom du host
     */
    const PARAM_host = 'localhost';
    /**
     * @const PARAM_db_name Nom de la BDD
     */
    const PARAM_db_name = 'reservation';
    /**
     * @const PARAM_user Nom du user
     */
    const PARAM_user = 'root';
    /**
     * @const PARAM_db_pass Mot de passe du user
     */
    const PARAM_db_pass = 'password';

    /**
     * BDD constructor.
     * @param null $options
     */
    private function __construct($options = null)
    {
        $this->dbh = new PDO('mysql:host=' . BDD::PARAM_host . ';charset=utf8mb4;dbname=' . BDD::PARAM_db_name,
            BDD::PARAM_user,
            BDD::PARAM_db_pass, $options);
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    }

    /**
     * @return BDD|null
     */
    public static function getPDOInstance(){
        if (!self::$instance instanceof self){
            self::$instance = new self;
        }
    return self::$instance;
    }


    /**
     * @return PDO
     */
    public function getDbh()
    {
        return $this->dbh;
    }

}