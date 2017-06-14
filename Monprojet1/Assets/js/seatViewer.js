/**
 * seatViewer.js
 * Fichier qui permet d'afficher les places
 * totales/disponibles/réservées
 */
$(document).ready(function () {
var typeSalle = $('#typeSalle').val();

$('#salle1').hide();
$('#salle2').hide();

typeSalle = $('#typeSalle').val();

$('#salle'+typeSalle).show();

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
                         for (var i = 0; i < bookedSeats.length ; i++) {
                         	//var placeHtmlCheckbox = $("#"+bookedSeats[i]);
                         	//var parentHtmlLi = placeHtmlCheckbox.parent();
                         	//parentHtmlLi.find('label').attr('disabled',true);
                             $("#"+bookedSeats[i]).prop('disabled', true); //permet de mettre en rouge les places
                             // réservées
				        }

                } else {
                    bookedSeats = [0]; //si aucunes places réservées
                }
            }
        });
};

//la classe 
if ($('.bookedPlaces').length > 0 ){
        viewBookedSeats();
}

   



});