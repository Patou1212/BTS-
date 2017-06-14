<?php

/* 
Description of Regexp
 * Cette classe permet d'effectuer des controles sur une donnée entrée par l'utilisateur afin de vérifier qu'elle correspond au format désiré.
 * On instanciera un objet Regexp pour effectuer un controle a chaque fois qu'une donnée entrée par un user devra etre insérer en BDD
 */

class Regexp{
    
    /*
     *  @var string $expression  The expression to check sent by the user
     */
    private $expression;
    
    
     /*
     *  @var boolean $isValid  A boolean that indicates validity of the user expression comapred to the pattern. 
     * When an expression matches a pattern  $isValid become true
     */
    private $isValid = false;
    
    

    
    function __construct($expression) {
        $this->expression = $expression;
    }
    
    
    /**
     * Method regexpMail checks if the expression respects classic mail format (content@content.content)
     * @return null
     */
    public function regexpMail(){
        
        $email = $this->expression;

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->isValid = true;
        }
        
    }
    
     /**
      * Method regexpMail checks if the expression respects classic names format (only letters/ no alphanumeric)
     * @return null
     */
    public function regexpNames(){
        
        $name = $this->expression;
        
        if (preg_match('/^[a-zA-Z ]*$/', $name)){
            $this->isValid = true;
        }
    }
    
    /**
     * @return boolean $isValid Validity of the expression
     */
    public function getIsValid() {
        return $this->isValid;
    }




    

    
}
