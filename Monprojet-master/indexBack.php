<?php
session_start();
require 'Autoloader.php';
Autoloader::register();
?>
<?php include 'Assets/includes/backOffice/headerHome-b.php'; ?>

<!-- Page Content -->
<div class="container">

    <hr>
    <hr>

    <div class="row">
        <div class="col-sm-4">
            <a href="Controllers/CreationEvent.php"><img class="img-circle img-responsive img-center img1" alt=""></a>
            <h2>Création d'un événement</h2>
            <p>Formulaire qui permet de créer un événement à une date souhaité.</p>
        </div>
        <div class="col-sm-4">
            <a href="Controllers/ListeEvent.php"><img class="img-circle img-responsive img-center img2" alt=""></a>
            <h2>Liste des événements</h2>
            <p>Liste qui vous permez de visionner tous les événements programmés, et accéder aux détails d'un
                événement.</p>
        </div>
        <div class="col-sm-4">
            <a href="Controllers/AnnulationEvent.php"><img class="img-circle img-responsive img-center cancel" alt=""></a>
            <h2>Annulation des inscriptions</h2>
            <p>Liste qui vous permez de supprimer les places réservées par un utilisateur pour un événement.</p>
        </div>
    </div>
    <!-- /.row -->

    <hr>
    <hr>

<?php include 'Assets/includes/backOffice/footerHome-b.php'; ?>