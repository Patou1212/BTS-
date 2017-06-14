<?php

include '../Assets/includes/backOffice/header-b.php';
?>
    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($message)) {
                echo
                    //<!-- Message -->
                "<div class='col-md-4 col-md-offset-4 alert alert-success fade in'>
                         <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                         <strong>$message</strong>
                    </div>";
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <form class="form-horizontal" action="CreationEventExt.php" method="post" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend><h1>Création d'événement</h1></legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEventExt">Nom de l'événement</label>
                        <div class="col-md-4">
                            <input id="TitreEventExt" name="TitreEventExt" placeholder="Nom de votre événement"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>

                      <!-- DatePicker -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dateEventExt">Date de votre événement</label>

                        <div class="col-md-4" id="datepicker"><input type="text" hidden value="" id="inputDate"
                                                                     name="inputDate"/></div>

                    </div>

                   <div class="form-group">
                        <label class="col-md-4 control-label" for="adresse">Adresse</label>
                        <div class="col-md-4">
                            <input id="adresse" name="adresse" placeholder="Entrer votre Adresse"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>

                  <div class="form-group">
                        <label class="col-md-4 control-label" for="ville">Ville</label>
                        <div class="col-md-4">
                            <input id="ville" name="ville" placeholder="Votre Ville"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>


                     <div class="form-group">
                        <label class="col-md-4 control-label" for="cp">Code Postal</label>
                        <div class="col-md-4">
                            <input id="cp" name="cp" placeholder="Code Postal"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ValiderCreationEventExt"></label>
                        <div class="col-md-4">
                            <button id="ValiderCreationEventExt" name="ValiderCreationEventExt" class="btn btn-primary">
                                Valider
                            </button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- /.row -->
<?php include '../Assets/includes/backOffice/footer-b.php'; ?>

   