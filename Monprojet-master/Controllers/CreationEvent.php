<?php
require '../Autoloader.php';
Autoloader::register();

// set variable
$dir_dest = '../Assets/images/affiche';

$myEvent = new Event();

$tabEvent = $myEvent->getTypesEvent();
$htmlSelectList = ' ';

foreach ($tabEvent as $event) {
    $htmlSelectList .= '<option value=' . $event->idType . '>' . $event->libelleType . '</option>';
}

$tabSalles = $myEvent->getSalles();
$selectListSalles = ' <option value="0">-- Choisir une salle --</option>';

foreach ($tabSalles as $salle) {
    $selectListSalles .= '<option value=' . $salle->idSalle . '>' . $salle->nomSalle . '</option>';
}

//On verifie que tous les champs ont été remplis, et que l'utilisateur a cliqué sur 'Valider'
if (isset($_POST['TitreEvent'], $_POST['inputDate'], $_POST['TypeEvent'], $_POST['TypeSalle'], $_POST['ValiderCreationEvent'])) {

    // on stocke dans des variables les infos rentrés par l'utilisateur
    $titre = $_POST['TitreEvent'];
    $date = $_POST['inputDate'];
    $type = $_POST['TypeEvent'];
    $salle = $_POST['TypeSalle'];


    // si on inclue une affiche à l'événement
    if (isset($_POST['upload'])) {

        // ---------- SIMPLE UPLOAD ----------
        // we create an instance of the class, giving as argument the PHP object
        // corresponding to the file field from the form
        // All the uploads are accessible from the PHP object $_FILES
        $handle = new Upload($_FILES['uploadAffiche']);

        // then we check if the file has been uploaded properly
        // in its *temporary* location in the server (often, it is /tmp)
        if ($handle->uploaded) {

            //save uploaded image with a new name,
            //resized to 150px wide, only image format
            $handle->file_new_name_body = 'affiche_' . $titre;
            $handle->allowed = array('image/*');
            $handle->forbidden = array('application/*');
            $handle->image_resize = true;
            $handle->image_x = 150;
            $handle->image_ratio_y = true;

            // yes, the file is on the server
            // now, we start the upload 'process'. That is, to copy the uploaded file
            // from its temporary location to the wanted location
            // It could be something like $handle->Process('/home/www/my_uploads/');
            $handle->Process($dir_dest);

            // we check if everything went OK
            if ($handle->processed) {
                // everything was fine !
                //$path = $dir_dest. '/' . $handle->file_dst_name;
                $path = $handle->file_dst_name;
                $eventToCreate = new Event();
                $returnInsertion = $eventToCreate->insertNewEvent($titre, $date, $type, $salle, $path);

                $message = $returnInsertion;
                // we delete the temporary files
                $handle->Clean();
            } else {
                // one error occured
                $message = "Erreur lors de l'upload: " . $handle->error . '';

            }

        } else {
            // si on n'inclue pas d'affiche à l'évènement
            $eventToCreate = new Event();
            $returnInsertion = $eventToCreate->insertNewEvent($titre, $date, $type, $salle);

            $message = $returnInsertion;
        }
    }
}

include '../Views/CreationEvenement.php';