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

            <form class="form-horizontal" action="CreationEvent.php" method="post" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend><h1>Création d'événement</h1></legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEvent">Nom de l'événement</label>
                        <div class="col-md-4">
                            <input id="TitreEvent" name="TitreEvent" placeholder="Titre événement"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>

                    <!-- DatePicker -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEvent">Date de l'événement</label>

                        <div class="col-md-4" id="datepicker"><input type="text" hidden value="" id="inputDate"
                                                                     name="inputDate"/></div>

                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TypeEvent">Type de l'événement</label>
                        <div class="col-md-4">
                            <select id="TypeEvent" name="TypeEvent" class="form-control">
                                <?php echo $htmlSelectList; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TypeSalle">Choix de la salle</label>
                        <div class="col-md-4">
                            <select id="TypeSalle" name="TypeSalle" class="form-control">
                                <?php echo $selectListSalles ?>
                            </select>
                        </div>
                    </div>

                    <!-- Upload File -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="affiche">Sélection de l'affiche</label>
                        <div class="col-md-4">
                            <span class="fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Choisissez un fichier</span>
                                <input type="file" size="32" name="uploadAffiche" value="">
                                <input type="hidden" name="upload" value="simple"/>
                            </span>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ValiderCreationEvent"></label>
                        <div class="col-md-4">
                            <button id="ValiderCreationEvent" name="ValiderCreationEvent" class="btn btn-primary">
                                Valider
                            </button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <!-- SALLE #1 -->
            <div class="salle1">
                <!-- SCENE -->
                <div class="scene1">
                    <h1>SCENE</h1>
                </div>
                <!-- EXIT FRONT-->
                <div class="exit front mur"></div>
                <!-- SEATS -->
                <ol class="mur">
                    <!-- RANK #1 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1A"/>
                                <label for="1A">1A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1B"/>
                                <label for="1B">1B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1C"/>
                                <label for="1C">1C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1D"/>
                                <label for="1D">1D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1E"/>
                                <label for="1E">1E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="1F"/>
                                <label for="1F">1F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #2 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2A"/>
                                <label for="2A">2A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2B"/>
                                <label for="2B">2B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2C"/>
                                <label for="2C">2C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2D"/>
                                <label for="2D">2D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2E"/>
                                <label for="2E">2E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="2F"/>
                                <label for="2F">2F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #3 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3A"/>
                                <label for="3A">3A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3B"/>
                                <label for="3B">3B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3C"/>
                                <label for="3C">3C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3D"/>
                                <label for="3D">3D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3E"/>
                                <label for="3E">3E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="3F"/>
                                <label for="3F">3F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #4 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4A"/>
                                <label for="4A">4A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4B"/>
                                <label for="4B">4B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4C"/>
                                <label for="4C">4C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4D"/>
                                <label for="4D">4D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4E"/>
                                <label for="4E">4E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="4F"/>
                                <label for="4F">4F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #5 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5A"/>
                                <label for="5A">5A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5B"/>
                                <label for="5B">5B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5C"/>
                                <label for="5C">5C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5D"/>
                                <label for="5D">5D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5E"/>
                                <label for="5E">5E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="5F"/>
                                <label for="5F">5F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #6 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6A"/>
                                <label for="6A">6A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6B"/>
                                <label for="6B">6B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6C"/>
                                <label for="6C">6C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6D"/>
                                <label for="6D">6D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6E"/>
                                <label for="6E">6E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="6F"/>
                                <label for="6F">6F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #7 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7A"/>
                                <label for="7A">7A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7B"/>
                                <label for="7B">7B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7C"/>
                                <label for="7C">7C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7D"/>
                                <label for="7D">7D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7E"/>
                                <label for="7E">7E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="7F"/>
                                <label for="7F">7F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #8 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8A"/>
                                <label for="8A">8A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8B"/>
                                <label for="8B">8B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8C"/>
                                <label for="8C">8C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8D"/>
                                <label for="8D">8D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8E"/>
                                <label for="8E">8E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="8F"/>
                                <label for="8F">8F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #9 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9A"/>
                                <label for="9A">9A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9B"/>
                                <label for="9B">9B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9C"/>
                                <label for="9C">9C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9D"/>
                                <label for="9D">9D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9E"/>
                                <label for="9E">9E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="9F"/>
                                <label for="9F">9F</label>
                            </li>
                        </ol>
                    </li>
                    <!-- RANK #10 -->
                    <li class="">
                        <ol class="seats" type="A">
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10A"/>
                                <label for="10A">10A</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10B"/>
                                <label for="10B">10B</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10C"/>
                                <label for="10C">10C</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10D"/>
                                <label for="10D">10D</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10E"/>
                                <label for="10E">10E</label>
                            </li>
                            <li class="seat seatAlone">
                                <input type="checkbox" id="10F"/>
                                <label for="10F">10F</label>
                            </li>
                        </ol>
                    </li>
                </ol>
                <!-- EXIT BACK-->
                <div class="exit back mur"></div>

            </div>
            <!-- ./SALLE #1 -->

            <!-- SALLE #2 -->
            <div class="salle2">
                <!-- SCENE -->
                <div class="scene2">
                    <h1>SCENE</h1>
                </div>
                <!-- EXIT FRONT-->
                <div class="exit front mur"></div>
                <div class="seats">
                    <!-- SEATS LEFT-->
                    <div class="left">
                        <ol>
                            <!-- RANK #1 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1A"/>
                                        <label for="1A">1A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1B"/>
                                        <label for="1B">1B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1C"/>
                                        <label for="1C">1C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1D"/>
                                        <label for="1D">1D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1E"/>
                                        <label for="1E">1E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="1F"/>
                                        <label for="1F">1F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #2 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2A"/>
                                        <label for="2A">2A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2B"/>
                                        <label for="2B">2B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2C"/>
                                        <label for="2C">2C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2D"/>
                                        <label for="2D">2D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2E"/>
                                        <label for="2E">2E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="2F"/>
                                        <label for="2F">2F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #3 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3A"/>
                                        <label for="3A">3A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3B"/>
                                        <label for="3B">3B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3C"/>
                                        <label for="3C">3C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3D"/>
                                        <label for="3D">3D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3E"/>
                                        <label for="3E">3E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="3F"/>
                                        <label for="3F">3F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #4 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4A"/>
                                        <label for="4A">4A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4B"/>
                                        <label for="4B">4B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4C"/>
                                        <label for="4C">4C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4D"/>
                                        <label for="4D">4D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4E"/>
                                        <label for="4E">4E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="4F"/>
                                        <label for="4F">4F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #5 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5A"/>
                                        <label for="5A">5A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5B"/>
                                        <label for="5B">5B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5C"/>
                                        <label for="5C">5C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5D"/>
                                        <label for="5D">5D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5E"/>
                                        <label for="5E">5E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="5F"/>
                                        <label for="5F">5F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #6 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6A"/>
                                        <label for="6A">6A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6B"/>
                                        <label for="6B">6B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6C"/>
                                        <label for="6C">6C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6D"/>
                                        <label for="6D">6D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6E"/>
                                        <label for="6E">6E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="6F"/>
                                        <label for="6F">6F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #7 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7A"/>
                                        <label for="7A">7A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7B"/>
                                        <label for="7B">7B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7C"/>
                                        <label for="7C">7C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7D"/>
                                        <label for="7D">7D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7E"/>
                                        <label for="7E">7E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="7F"/>
                                        <label for="7F">7F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #8 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8A"/>
                                        <label for="8A">8A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8B"/>
                                        <label for="8B">8B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8C"/>
                                        <label for="8C">8C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8D"/>
                                        <label for="8D">8D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8E"/>
                                        <label for="8E">8E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="8F"/>
                                        <label for="8F">8F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #9 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9A"/>
                                        <label for="9A">9A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9B"/>
                                        <label for="9B">9B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9C"/>
                                        <label for="9C">9C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9D"/>
                                        <label for="9D">9D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9E"/>
                                        <label for="9E">9E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="9F"/>
                                        <label for="9F">9F</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #10 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10A"/>
                                        <label for="10A">10A</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10B"/>
                                        <label for="10B">10B</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10C"/>
                                        <label for="10C">10C</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10D"/>
                                        <label for="10D">10D</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10E"/>
                                        <label for="10E">10E</label>
                                    </li>
                                    <li class="seat seatLeft">
                                        <input type="checkbox" id="10F"/>
                                        <label for="10F">10F</label>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <!-- SEATS CENTER-->
                    <div class="center">
                        <ol>
                            <!-- RANK #1 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1G"/>
                                        <label for="1G">1G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1H"/>
                                        <label for="1H">1H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1I"/>
                                        <label for="1I">1I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1J"/>
                                        <label for="1J">1J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1K"/>
                                        <label for="1K">1K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="1L"/>
                                        <label for="1L">1L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #2 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2G"/>
                                        <label for="2G">2G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2H"/>
                                        <label for="2H">2H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2I"/>
                                        <label for="2I">2I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2J"/>
                                        <label for="2J">2J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2K"/>
                                        <label for="2K">2K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="2L"/>
                                        <label for="2L">2L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #3 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3G"/>
                                        <label for="3G">3G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3H"/>
                                        <label for="3H">3H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3I"/>
                                        <label for="3I">3I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3J"/>
                                        <label for="3J">3J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3K"/>
                                        <label for="3K">3K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="3L"/>
                                        <label for="3L">3L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #4 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4G"/>
                                        <label for="4G">4G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4H"/>
                                        <label for="4H">4H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4I"/>
                                        <label for="4I">4I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4J"/>
                                        <label for="4J">4J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4K"/>
                                        <label for="4K">4K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="4L"/>
                                        <label for="4L">4L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #5 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5G"/>
                                        <label for="5G">5G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5H"/>
                                        <label for="5H">5H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5I"/>
                                        <label for="5I">5I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5J"/>
                                        <label for="5J">5J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5K"/>
                                        <label for="5K">5K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="5L"/>
                                        <label for="5L">5L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #6 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6G"/>
                                        <label for="6G">6G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6H"/>
                                        <label for="6H">6H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6I"/>
                                        <label for="6I">6I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6J"/>
                                        <label for="6J">6J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6K"/>
                                        <label for="6K">6K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="6L"/>
                                        <label for="6L">6L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #7 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7G"/>
                                        <label for="7G">7G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7H"/>
                                        <label for="7H">7H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7I"/>
                                        <label for="7I">7I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7J"/>
                                        <label for="7J">7J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7K"/>
                                        <label for="7K">7K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="7L"/>
                                        <label for="7L">7L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #8 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8G"/>
                                        <label for="8G">8G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8H"/>
                                        <label for="8H">8H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8I"/>
                                        <label for="8I">8I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8J"/>
                                        <label for="8J">8J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8K"/>
                                        <label for="8K">8K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="8L"/>
                                        <label for="8L">8L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #9 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9G"/>
                                        <label for="9G">9G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9H"/>
                                        <label for="9H">9H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9I"/>
                                        <label for="9I">9I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9J"/>
                                        <label for="9J">9J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9K"/>
                                        <label for="9K">9K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="9L"/>
                                        <label for="9L">9L</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #10 -->
                            <li class="">
                                <ol class="seats" type="A">
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10G"/>
                                        <label for="10G">10G</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10H"/>
                                        <label for="10H">10H</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10I"/>
                                        <label for="10I">10I</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10J"/>
                                        <label for="10J">10J</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10K"/>
                                        <label for="10K">10K</label>
                                    </li>
                                    <li class="seat seatCenter">
                                        <input type="checkbox" id="10L"/>
                                        <label for="10L">10L</label>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <!-- SEATS RIGHT-->
                    <div class="right">
                        <ol>
                            <!-- RANK #1 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1M"/>
                                        <label for="1M">1M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1N"/>
                                        <label for="1N">1N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1O"/>
                                        <label for="1O">1O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1P"/>
                                        <label for="1P">1P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1Q"/>
                                        <label for="1Q">1Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="1R"/>
                                        <label for="1R">1R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #2 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2M"/>
                                        <label for="2M">2M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2N"/>
                                        <label for="2N">2N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2O"/>
                                        <label for="2O">2O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2P"/>
                                        <label for="2P">2P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2Q"/>
                                        <label for="2Q">2Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="2R"/>
                                        <label for="2R">2R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #3 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3M"/>
                                        <label for="3M">3M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3N"/>
                                        <label for="3N">3N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3O"/>
                                        <label for="3O">3O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3P"/>
                                        <label for="3P">3P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3Q"/>
                                        <label for="3Q">3Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="3R"/>
                                        <label for="3R">3R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #4 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4M"/>
                                        <label for="4M">4M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4N"/>
                                        <label for="4N">4N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4O"/>
                                        <label for="4O">4O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4P"/>
                                        <label for="4P">4P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4Q"/>
                                        <label for="4Q">4Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="4R"/>
                                        <label for="4R">4R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #5 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5M"/>
                                        <label for="5M">5M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5N"/>
                                        <label for="5N">5N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5O"/>
                                        <label for="5O">5O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5P"/>
                                        <label for="5P">5P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5Q"/>
                                        <label for="5Q">5Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="5R"/>
                                        <label for="5R">5R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #6 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6M"/>
                                        <label for="6M">6M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6N"/>
                                        <label for="6N">6N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6O"/>
                                        <label for="6O">6O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6P"/>
                                        <label for="6P">6P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6Q"/>
                                        <label for="6Q">6Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="6R"/>
                                        <label for="6R">6R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #7 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7M"/>
                                        <label for="7M">7M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7N"/>
                                        <label for="7N">7N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7O"/>
                                        <label for="7O">7O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7P"/>
                                        <label for="7P">7P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7Q"/>
                                        <label for="7Q">7Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="7R"/>
                                        <label for="7R">7R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #8 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8M"/>
                                        <label for="8M">8M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8N"/>
                                        <label for="8N">8N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8O"/>
                                        <label for="8O">8O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8P"/>
                                        <label for="8P">8P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8Q"/>
                                        <label for="8Q">8Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="8R"/>
                                        <label for="8R">8R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #9 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9M"/>
                                        <label for="9M">9M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9N"/>
                                        <label for="9N">9N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9O"/>
                                        <label for="9O">9O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9P"/>
                                        <label for="9P">9P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9Q"/>
                                        <label for="9Q">9Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="9R"/>
                                        <label for="9R">9R</label>
                                    </li>
                                </ol>
                            </li>
                            <!-- RANK #10 -->
                            <li class=" rowRight">
                                <ol class="seats" type="A">
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10M"/>
                                        <label for="10M">10M</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10N"/>
                                        <label for="10N">10N</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10O"/>
                                        <label for="10O">10O</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10P"/>
                                        <label for="10P">10P</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10Q"/>
                                        <label for="10Q">10Q</label>
                                    </li>
                                    <li class="seat seatRight">
                                        <input type="checkbox" id="10R"/>
                                        <label for="10R">10R</label>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- EXIT BACK-->
                <div class="exit back mur"></div>
            </div>
            <!-- ./SALLE #2 -->
        </div>
    </div>
    <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>