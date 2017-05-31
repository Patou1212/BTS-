<?php
/**
 * Created by PhpStorm.
 * User: Michel
 * Date: 06/10/2016
 * Time: 09:12
 */
include '../Assets/includes/backOffice/header-b.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" action="DetailEvent.php" method="post">
                <fieldset>

                    <!-- Form Name -->
                    <legend><h1>Liste des événements</h1></legend>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ChoixEvent">Choix de l'événement</label>
                        <div class="col-md-4">
                            <select id="ChoixEvent" name="ChoixEvent" class="form-control">
                                <?php echo $listeEvent ?>
                            </select>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ValiderChoixEvent"></label>
                        <div class="col-md-4">
                            <button id="ValiderChoixEvent" name="ValiderChoixEvent" class="btn btn-primary">Valider
                            </button>
                        </div>
                    </div>
                   
                </fieldset>
            </form>
        </div>
    </div>
    <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>