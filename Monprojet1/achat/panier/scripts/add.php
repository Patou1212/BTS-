<?php
session_start();
require_once ('../include/inc_connexion.php'); 

$id= strip_tags($_GET['id']); //protection faille XSS

//ajout requete pour controler le stock et id

$rep = $bdd -> prepare ('SELECT StockProduct FROM products WHERE IDProduct = ?');
$rep -> execute (array($id));
$row = $rep -> fetch();
$stock = $row['StockProduct'];


if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
{
$_SESSION ['panier'][$id] ++;
header('location:../panier.php');
exit;
}
else
{
$_SESSION ['stock_error'] = 'Le stock est insuffisant.';
header('location:../panier.php');
exit;
}