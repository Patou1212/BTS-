<?php
session_start();

$id= strip_tags($_GET['id']); //protection faille XSS

//ajout requete pour controler le stock et id

if ($_SESSION ['panier'][$id] > 0)
// pour éviter d'acheter une quantité négative !
{

$_SESSION ['panier'][$id] --;

	if (($_SESSION ['panier'][$id] === 0) AND (count($_SESSION['panier']) > 1))
	{
	unset ($_SESSION ['panier'][$id]);

	header('location:../panier.php');
	exit;
	}
	elseif (($_SESSION ['panier'][$id] === 0) AND (count($_SESSION['panier']) === 1))
	{
	$_SESSION ['panier'] = array();
	
	$_SESSION['del'] = 'del';

	header('location:../panier.php');
	exit;
	}
	else
	{
	header('location:../panier.php');
	exit;
	}
}
else
{
header('location:../panier.php');
exit;
}


