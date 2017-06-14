<?php
/**
 * Created by PhpStorm.
 * User: Michel
 * Date: 06/10/2016
 * Time: 09:12
 */
include '../Assets/includes/backOffice/header-b.php';
?>
    <!-- Confirm Modal -->
    <div class="container">
        <div class="row">
            <div id="myModal" class="modal fade in">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="btn btn-default" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-remove"></span></a>
                            <h4 class="modal-title">ATTENTION</h4>
                        </div>
                        <div class="modal-body">
                            <h4>Confirmation de suppression</h4>
                            <p>Cette opération est irréversible, veuillez confirmer votre choix.</p>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button class="btn btn-danger" data-dismiss="modal"><span
                                        class="glyphicon glyphicon-remove"></span> Annuler
                                </button>
                                <button id="modalConfirmAnnulation" class="btn btn-primary"><span class="glyphicon
                                glyphicon-check"></span>
                                    Confirmer
                                </button>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Title Name -->
                <legend><h1>Annulation inscription</h1></legend>

                <!-- DatePicker -->
                <div class="col-md-12">
                    <label class="col-md-4 control-label text-right" for="datepicker">Choissisez un évènement : </label>
                    <div class="col-md-4" id='datepickerAnnulation'></div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <hr>
                    <h2 id='titre'>Annulation de certains participants pour l'évènement : <strong><span
                                id='titreEvent'></span></strong>
                    </h2>
                    <div id="headTable" class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Utilisateurs</h3>
                        </div>
                        <table class="table table-bordered table-striped" id='personne'>
                            <thead class="thead-inverse">
                            <tr>
                                <th>Nom Participant</th>
                                <th>Prénom Participant</th>
                                <th>Mail Participant</th>
                                <th>Nombre de places Achetées</th>
                                <th>Supprimer</th>
                            </tr>
                            </thead>
                            <tbody id='tbody'>
                            </tbody>
                        </table>

                        <span id='eventVide'></span>
                        <div/>
                    </div>

                </div>
            </div>
            <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>