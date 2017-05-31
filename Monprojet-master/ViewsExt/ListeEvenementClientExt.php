<?php
/**
 * Vue ListeEvenementClient.php
 * Permet à l'utilisateur de visualiser les événements disponibles
 * et de basculer sur la page de réservation
 */
include '../Assets/includes/frontOffice/header-f.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">


            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="../ControllersExt/actualiseEventExt.php" method="post">
                        <fieldset>
                            <!-- Form Name -->
                            <legend><h1 id='listEvent'>Liste des événements disponibles</h1></legend>
                            <!-- DatePicker -->
                            <div class="form-group">
                                <label class="col-md-4 control-label text-right" for="datepicker">Choissisez un
                                    évènement : </label>
                                <div class="col-md-4" id="datepicker" name="datePicker"></div>
                                <!-- Affiche Event -->
                                <div class="col-md-4">
                                    <img id="afficheEvent" src="" alt="" class="img-responsive">
                                </div>

                                <input type="text" hidden="true" name="datePicked" id="datePicked"/>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ValiderEvent"></label>
                                <div class="col-md-4">
                                    <button id="ValiderEvent" name="ValiderEvent" class="btn btn-primary">
                                        Participer à cet événement !
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->


        <?php include '../Assets/includes/frontOffice/footer-f.php'; ?>

    