<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bienvenue Chez ADECAF</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/2-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mon projet/index2.php">ADECAF Accueil</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="panier/index.php">Liste des Materiaux</a>
                    </li>
                    <li>
                        <a href="panier/panier.php">Annulation achat</a>
                    </li>
					<aside id="panier">
							<p><a href="panier.php">Votre panier</a></p>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<header>

<?php 
//si le panier n'est pas vide
if (!empty($_SESSION ['panier']))
{
	$nb_article = count($_SESSION ['panier']); //on compte le nb d'éléments du panier
	
		if ($nb_article === 1) // pour écrire article sans S !
		{
		?>
		<p><?php echo $nb_article.' article';?></p>
		<?php
		}
		else
		{
		?>
		<p><?php echo $nb_article.' articles';?></p>
		<?php
		}
	
}
elseif (isset($_COOKIE['panier'])) // qd on retourne sur le site plus tard, on joue sur le cookie
{
$_SESSION ['panier'] = unserialize ($_COOKIE['panier']); //on désérialise le cookie

	$nb_article = count($_SESSION ['panier']);
	
		if ($nb_article === 1)
		{
		?>
		<p><?php echo $nb_article.' article';?></p>
		<?php
		}
		else
		{
		?>
		<p><?php echo $nb_article.' articles';?></p>
		<?php
		}

}
else // s'il n'y a pas de session, ni de cookie
{
?>

<?php
}
?>
</aside>

</header>