<?php
/**
 * Vue InscriptionEvenementClientExt.php
 * Permet à l'utilisateur d'effectuer une réservation
 */
include '../Assets/includes/frontOffice/header-f.php';
?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="inscriptionEventExt" class="form-horizontal" method="post" >
                    <fieldset>

                        <!-- Form Name -->
                        <legend><h1>Inscription à un événement</h1></legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="NomUser">Nom</label>
                            <div class="col-md-4">
                                <input id="NomUser" name="NomUser" placeholder="Votre nom" class="form-control input-md"
                                       required="" type="text" onblur="this.value=this.value.Majuscule()">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="PrenomUser">Prénom</label>
                            <div class="col-md-4">
                                <input id="PrenomUser" name="PrenomUser" placeholder="Votre prénom"
                                       class="form-control input-md"
                                       required="" type="text" onblur="this.value=this.value.Majuscule()">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="MailUser">E-mail</label>
                            <div class="col-md-4">
                                <input id="MailUser" name="MailUser" placeholder="Votre e-mail"
                                       class="form-control input-md"
                                       required="" type="email">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ValiderEvent"></label>
                        <div class="col-md-8">
                            <input id="ValiderParticipation" name="ValiderParticipation" type="submit"
                                   class="btn btn-success" />
                            <a href="../ControllersExt/ListeEventClientExt .php" class="btn btn-danger"
                               role="button">Retour</a>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <!-- /.row -->

<?php include '../Assets/includes/frontOffice/footer-f.php'; ?>