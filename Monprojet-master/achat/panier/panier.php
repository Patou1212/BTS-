<?php 

session_start(); 
require('include/inc_refresh.php'); 
require_once ('include/inc_connexion.php'); 
require ('scripts/session_panier.php');

?>	

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<title>Ma p'tite boutique</title>
<link rel="stylesheet" href="css/style.css" media="screen" />
</head>
<body>
<div id="wrapper">

<?php require_once ('include/inc_header.php') ?>

<h1 class="titre_panier">Votre Panier</h1>

<?php
if (isset ($message)) //affichage message erreur
{
?>
<p class="erreur">
<?php echo $message;
exit; ?></p> <!-- on stoppe le script ici car pas la peine d'affichage un tableau vide !-->
<?php
}

if (isset ($_SESSION ['stock_error']))
{
?>
<p class="erreur"><?php echo $_SESSION ['stock_error'];?></p>
<?php
unset ($_SESSION ['stock_error']);
}
?>

<section>

<p class="lien_retour"><a href="index.php">Continuez vos achats</a></p>

<table>

<thead>
<tr>
<th>Article</th>
<th>Quantité</th>
<th>Prix unitaire TTC</th>
<th>Prix total TTC</th>
<th>Supprimer</th>
</tr>
</thead>
<tbody>

<?php 

$grand_total = 0; //initialisation de $grand_total

foreach ($_SESSION ['panier'] as $key => $qte) //lecture du panier
{

$rep = $bdd -> prepare ('SELECT * FROM products WHERE IDProduct= ?');
$rep -> execute (array($key));

$donnees = $rep -> fetch();

$nom = $donnees ['NameProduct'];
$prix = $donnees ['PriceProduct'];
$prix_total = $prix*$qte; //calculs prix total et total à payer TTC

$grand_total += $prix_total;

?>

<tr>
<td><?php echo $nom; ?></td>
<td><a class="choix_quantite" href="scripts/less.php?id=<?php echo $key; ?>">-</a><span><?php echo $qte;?></span><a class="choix_quantite" href="scripts/add.php?id=<?php echo $key;?>">+</a></td>
<td><?php echo $prix.'€'; ?></td>
<td><?php echo $prix_total.'€'; ?></td>
<td><a class="supprimer_article" href="scripts/del.php?id=<?php echo $key; ?>">x</a></td>
</tr>

<?php
}

?>
</tbody>

<tfoot>
<tr>
<td class="no_border"></td>
<td class="no_border"></td>
<td class="table_bold">TOTAL</td>
<td class="bold"><?php echo $grand_total.'€'; ?> </td>
</tr>
<tr>
<td class="no_border"></td>
<td class="no_border"></td>
<td class="table_small">dont TVA 20%</td>
<td class="small"><?php echo round ($tva = $grand_total -($grand_total*0.8),2).'€' ;?></td>
</tr>
</tfoot>


</table>

<form action="#">
<input id="valider_panier" type="submit" name="valider" value="Valider le panier" />
</form>
</section>

<?php require_once('include/inc_footer.php'); ?>

</div>
</body>
</html>