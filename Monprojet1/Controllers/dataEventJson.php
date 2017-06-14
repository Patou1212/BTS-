<?php
session_start();
require '../Autoloader.php';
Autoloader::register();

echo $_SESSION['dataEvent']; 