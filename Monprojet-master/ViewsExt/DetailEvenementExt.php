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
        <form class="form-horizontal">
            <fieldset>

                <!-- Form Name -->
                <legend><h1>Détail de l'événement</h1></legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="TitreEventExt">Nom de l'événement</label>
                    <div class="col-md-4">
                        <input disabled id="TitreEventExt" name="TitreEventExt" placeholder="" class="form-control input-md"
                               type="text" value=" <?php echo $titreEventExt ?> ">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="TypeEventExt">Type de l'événement</label>
                    <div class="col-md-4">
                        <input disabled id="TypeEventExt" name="TypeEventExt" placeholder="" class="form-control input-md"
                               type="text" value="<?php echo $typeEventExt ?>">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="DateEventExt">Date de l'événement</label>
                    <div class="col-md-4">
                        <input disabled id="DateEventEXt" name="DateEventExt" placeholder="" class="form-control input-md"
                               type="text" value="<?php echo $dateEventExt ?>">

                    </div>
                </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="NbreParticipantsExt">Nombre de participants</label>
                    <div class="col-md-4">
                        <input disabled id="NbreParticipantsExt" name="NbreParticipantsExt" placeholder=""
                               class="form-control input-md"
                               type="text" value="<?php echo $nbParticipantsExt ?>">

                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="Retour"></label>
                    <div class="col-md-4">
                        <a href="../ControllersExt/ListeEventExt.php" class="btn btn-info" role="button">Retour</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    </div>


<?php include '../Assets/includes/backOffice/footer-b.php'; ?>