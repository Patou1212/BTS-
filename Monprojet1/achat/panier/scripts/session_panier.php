<?php
if (!empty ($_POST)) //si $_POST n'est pas vide 
{

foreach ($_POST as $key => $value)//boucle pour extraire l'id produit
{
$id = $key;
}


	if (isset ($_SESSION ['panier'][$id])) //si le produit fait déjà partie du panier
	{
		$rep = $bdd -> prepare ('SELECT StockProduct FROM products WHERE IDProduct = ?');

		$rep -> execute (array($id));

		$row = $rep -> fetch();

		$stock = $row['StockProduct'];

			// si le produit existe bien dans la table produit et si le stock est inférieur à la quatité
			if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
			{
	
			$_SESSION ['panier'][$id]++; //alors on ajoute 1
			
			//mise à jour cookie

			$panier = $_SESSION ['panier'];
			$cookie = serialize($panier);

			setcookie('panier', $cookie, time()+ 1296000);
			
			}
				
	}
	
	else //si le produit ne fait pas partie du panier
	{
	$_SESSION ['panier'][$id] = 1; //alors la qte vaut 1
	
	$panier = $_SESSION ['panier'];
	$cookie = serialize($panier);

	setcookie('panier', $cookie, time()+ 1296000); // création du cookie
	}

	
}

// si $_SESSION n'existe pas et $_COOKIE n'est pas vide
elseif ((!isset ($_SESSION ['panier'])) AND (!empty($_COOKIE['panier'])))
{
$_SESSION ['panier'] = unserialize($_COOKIE['panier']);
$panier = $_SESSION ['panier'];
$cookie = serialize($panier);

setcookie('panier', $cookie, time()+ 1296000);
}


// si $_SESSION ['del'] existe = cas d'une suppression d'article
elseif (isset ($_SESSION ['del']))
{
unset ($_SESSION ['del']);
setcookie ('panier', NULL, -1);
header('location:panier.php');
exit;
}

//sinon si $_SESSION ['panier'] n'existe pas alors on le créé vide, affichage message 

elseif (!isset($_SESSION['panier']))
{
$_SESSION ['panier'] = array ();
$message='Votre panier est vide.';		
}

//sinon si le panier est vide 
elseif ($_SESSION['panier'] === array())
{
$message='Votre panier est vide.';		
}



