<?php
session_start();
require 'Autoloader.php';
Autoloader::register();
?>
<?php include 'Assets/includes/backOffice/headerHome-b.php';?>

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
	inscription.php
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
			    				<input type="email" name="mail" id="mail" class="form-control input-sm" placeholder="Email ">
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
			    			
			    			<input type="submit" value="S'enregistrer" class="btn btn-info btn-block" action="mail/phpmailer">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

	
    </html>

