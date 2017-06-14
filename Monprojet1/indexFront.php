<?php
/**
 * Vue index.php
 * Page d'accueil du visiteur
 */
//Démarre une nouvelle session ou reprend une session existante
session_start();
//Autoloader permettant de charger les classes automatiquement
require 'Autoloader.php';
Autoloader::register();
?>
<?php include 'Assets/includes/frontOffice/headerHome-f.php'; ?>

<!-- Page Content -->
<div class="container">
    <hr>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <a href="Controllers/ListeEventClient.php"><img class="img-circle img-responsive img-center img2"
                                                            alt=""></a>
            <h2>Liste des événements</h2>
            <p>Liste qui vous permez de reservez vos places pour un événement.</p>
        </div>
    </div>
    <!-- /.row -->
    <hr>
    <hr>
<?php include 'Assets/includes/frontOffice/footerHome-f.php'; ?>