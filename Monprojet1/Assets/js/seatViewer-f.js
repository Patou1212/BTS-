/**
 * seatViewer.js
 * Fichier qui permet d'afficher les places
 * totales/disponibles/réservées
 */
$(document).ready(function () {
    // cache la div message de confirmation de réservation
    $('#confirmReservation').hide();
    $('#errorMessage').hide();
    $('#ValiderParticipation').hide();
    $.get("../Controllers/dataEventJson.php", function (data) //Je récupère les infos sur l'event en cours
    {
        $('li .seat').on('click', function () {
            $('#ValiderParticipation').show();
        })
        var typeSalle = data.idSalle;
        var nbPlaceSalle = data.nbPlacesSalle;
        $('.salle' + typeSalle).show();
        viewBookedSeats();
        $('#inscriptionEvent').submit(function (event) //soumission du formulaire 
        {
            event.preventDefault();
            var placesAchetees = [];
            i = 0;
            $('li .seat').each(function () // je boucle sur la liste pour voir lesquels ont été selectionnés
            {
                if ($(this).children('label').css('backgroundColor') === 'rgb(186, 218, 85)') //couleur de la chaise selectionnée
                {
                    placesAchetees[i] = $(this).children('input').attr('id'); //id de la chaise
                    i++;
                }

            })
            var nomPersonne = $('#NomUser').val();
            var prenomPersonne = $('#PrenomUser').val();
            var mailPersonne = $('#MailUser').val();
            // Postage des données
            $.get("../Controllers/seatPicked.php?placesAchetees=" + placesAchetees + "&nomPersonne=" + nomPersonne + "&prenomPersonne=" + prenomPersonne + "&mailPersonne=" + mailPersonne, function (data) {
                resultRequest = data.statusRequest;
                returnMessage = data.message;

                if (resultRequest == true) {
                    //Affiche le message de confirmation de réservation si l'user a choisi des places
                    $('#confirmReservation').show();
                    $('#confirmReservation').append(returnMessage);
                    $('#ValiderParticipation').hide();
                    viewBookedSeats();

                } else {

                    $('#errorMessage').show();
                    $('#errorMessage').append(returnMessage);
                    $('#ValiderParticipation').hide();
                }
            }, "json")

        })
    }, "json");


    viewBookedSeats = function () {
        //Array qui enregistre les places réservées pour l'event
        var bookedSeats = [];

        $.ajax({
            url: "../Controllers/EventSeatBookedPicker.php",
            dataType: "json",
            async: false,
            success: function (data) {
                if (data) {
                    bookedSeats = data.placeReserveEvent; //si places reservées
                    for (var i = 0; i < bookedSeats.length; i++) {
                        //var placeHtmlCheckbox = $("#"+bookedSeats[i]);
                        //var parentHtmlLi = placeHtmlCheckbox.parent();
                        //parentHtmlLi.find('label').attr('disabled',true);
                        $("#" + bookedSeats[i]).prop('disabled', true); //permet de mettre en rouge les places
                        // réservées
                    }

                } else {
                    bookedSeats = [0]; //si aucunes places réservées
                }
            }
        });

    };


});