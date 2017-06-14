<?php

/**
 * Class Autoloader
 */
class Autoloader
{
    /**
     * Enregistre notre autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class)
    {
        if (is_file('Controllers/' . $class . '.php')) {
            require_once 'Controllers/' . $class . '.php';
        } else if (is_file('../Models/' . $class . '.php')) {
            require_once '../Models/' . $class . '.php';
        }
    }
}