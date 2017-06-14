<?php
session_start();
require 'Autoloader.php';
Autoloader::register();
?>
<?php include 'Assets/includes/backOffice/headerHome-b.php'; ?>

<?php
// Redirige l'utilisateur s'il est déjà identifié
if(isset($_COOKIE["id"]))
{
     header("Location: evenement.php");
}
else
{
     
     // Formulaire visible par défaut
     $masquer_formulaire = false;
     
     // Une fois le formulaire envoyé
     if(isset($_POST["BT_Envoyer"]))
     {
          
          // Vérification de la validité des champs
          if(!ereg("^[A-Za-z0-9_]{4,20}$", $_POST["nom"]))
          {
               $message = "Votre nom d'utilisateur doit comporter entre 4 et 20 caractères<br />\n";
               $message .= "L'utilisation de l'underscore est autorisée";
          }
          elseif(!ereg("^[A-Za-z0-9]{4,}$", $_POST["password"]))
          {
               $message = "Votre mot de passe doit comporter au moins 4 caractères";
          }
          elseif($_POST["password"] != $_POST["confirmationp"])
          {
               $message = "Votre mot de passe n'a pas été correctement confirmé";
          }
          elseif(!ereg("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$",
               $_POST["email"]))
          {
               $message = "Votre adresse e-mail n'est pas valide";
          }
          else
          {
               
               // Connexion à la base de données
               // Valeurs à modifier selon vos paramètres configuration
        mysql_connect("localhost", "root", "password");
        mysql_select_db("reservation");
               
               // Vérification de l'unicité du nom d'utilisateur et de l'adresse e-mail
               $result = mysql_query("SELECT nom, email,  FROM inscription WHERE nom = '" . $_POST["nom"] . "' OR email = '" . $_POST["email"] . "'");
               
               // Si une erreur survient
               if(!$result)
               {
                    $message = "Erreur d'accès à la base de données lors de la vérification d'unicité";
               }
               else
               {
                    
                    // Si un enregistrement est trouvé
                    if(mysql_num_rows($result) > 0)
                    {
                         
                         while($row = mysql_fetch_array($result))
                         {
                              
                              if($_POST["nom"] == $row["nom"])
                              {
                                   $message = "Le nom d'utilisateur " . $_POST["nom"];
                                   $message .= "est déjà utilisé";
                              }
                              elseif($_POST["email"] == $row["email"])
                              {
                                   $message = "L'adresse e-mail " . $_POST["TB_Adresse_Email"];
                                   $message .= "est déjà utilisée";
                              }
                              
                         }
                         
                    }
                    else
                    {
                         
                         // Génération de la clef d'activation
                         $caracteres = array("a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
                         $caracteres_aleatoires = array_rand($caracteres, 8);
                         $clef_activation = "";
                         
                         foreach($caracteres_aleatoires as $i)
                         {
                              $clef_activation .= $caracteres[$i];
                         }
                         
                         // Création du compte utilisateur
                         $result = mysql_query("INSERT INTO inscription(`nom`,`prenom`, `adresse`, `email`, `password`, `confirmationp`, `confirmkey`)	VALUES ('$nom','$prenom', '$adresse', '$email', '$password', '$confirmationp', '?')");
                         
                         // Si une erreur survient
                         if(!$result)
                         {
                              $message = "Erreur d'accès à la base de données lors de la création du compte utilisateur";
                         }
                         else
                         {
                              
                              // Envoi du mail d'activation
                              $sujet = "Activation de votre compte utilisateur";
                              
                              $message = "Pour valider votre inscription, merci de cliquer sur le lien suivant :\n";
                              $message .= "http://" . $_SERVER["SERVER_NAME"];
                              $message .= "/activer-compte-utilisateur.php?id=" . mysql_insert_id();
                              $message .= "&clef=" . $clef_activation;
                              
                              // Si une erreur survient
                              if(!@mail($_POST["TB_Adresse_Email"], $sujet, $message))
                              {
                                   $message = "Une erreur est survenue lors de l'envoi du mail d'activation<br />\n";
                                   $message .= "Veuillez contacter l'administrateur afin d'activer votre compte";
                              }
                              else
                              {
                                   
                                   // Message de confirmation
                                   $message = "Votre compte utilisateur a correctement été créer<br />\n";
                                   $message .= "Un email vient de vous être envoyer afin de l'activer";
                                   
                                   // On masque le formulaire
                                   $masquer_formulaire = true;
                                   
                              }
                              
                         }
                         
                    }
                    
               }
               
          }
          
          // Fermeture de la connexion à la base de données
          mysql_close();
          
     }
     
}

?>

<html lang="fr">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INSCRIPTION</title>
	<script src="Assets/js/script.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="Assets/css/index2.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
<form method="POST"  action="inscription.php">
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">ESPACE MEMBER INSCRIPTION</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="nom" id="nom" class="form-control input-sm floatlabel" placeholder="Nom">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="prenom" id="prenom" class="form-control input-sm" placeholder="Prenom">
			    					</div>
			    				</div>
			    			</div>

							<div class="form-group">
			    				<input type="adresse" name="adresse" id="adresse" class="form-control input-sm" placeholder="Adresse">
			    			</div>


			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="confirmationp" id="confirmationp" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" value="S'enregistrer" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    </html>

