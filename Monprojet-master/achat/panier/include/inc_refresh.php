<?php

if (!empty($_POST)) //si $_POST n'est pas vide
{
$_SESSION['sauvegarde'] = $_POST; // sauvegarde de $_POST dans une session
$fichier=$_SERVER['PHP_SELF'];
header('location:'.$fichier);  // puis redirection vers panier.php
exit;
}

if (isset($_SESSION['sauvegarde'])) // si la session sauvegarde existe
{
$_POST = $_SESSION['sauvegarde']; // récupération du $_POST
unset ($_SESSION['sauvegarde']); //destruction de la session
}