/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    var dateEvent = [];
    var titreEvent = [];
    var nbPlaceEvent = [];
    var typeEvent = [];
    //set variable path de l'affiche
    var AfficheEvent;
    var currYear;


    $("#ValiderEvent").hide();

    $.get("../Controllers/EventDatePicker-f.php", function (data) {
        for (var i = 0; i < data.length; i++) {
            dateEvent[i] = data[i].dateEvent;
            titreEvent[i] = data[i].titreEvent;
            nbPlaceEvent[i] = data[i].nbPlaceEvent;
            typeEvent[i] = data[i].libelleType;
        }
        ;
        $("#datepicker").datepicker("destroy");
        $("#datepicker").datepicker(
            {
                prevText: 'Précédent',
                nextText: 'Suivant',
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                weekHeader: 'Sem.',
                dateFormat: 'yy-mm-dd',
                beforeShowDay: highlightDate,
                onSelect: function (dateChoisie, inst) {
                    $('#datePicked').val(dateChoisie);

                    $("#ValiderEvent").show();

                    //requête ajax qui permet de récupérer le path de l'affiche pour la date choisie
                    $.get("../Controllers/AfficheDatePicker-f.php?dataSent=" + dateChoisie, function (data) {

                        //path
                        AfficheEvent = data.afficheEvent;
                        //changement de l'attribut "src" pour l'affichage de l'image
                        $('#afficheEvent').attr("src", "../Assets/images/affiche/"+AfficheEvent);

                    }, "json")
                },
                /*
                 $.get("../Controllers/ListeEventClient.php?dateChoisie="+dateChoisie, function(data)
                 {

                 })*/

            });

        currYear = $('.ui-datepicker-year').html();

        $('#datepicker').datepicker("refresh");
    }, "json");

    $("#datepicker").on("click", function () {

        if ($('.ui-datepicker-year').html() != currYear) {
            var thisYear = $('.ui-datepicker-year').html()

            $.get("../Controllers/EventDatePickerInscription.php?dataSent=" + thisYear, function (data) {
                for (var i = 0; i < data.length; i++) {
                    dateEvent[i] = data[i].dateEvent;
                    titreEvent[i] = data[i].titreEvent;
                    nbPlaceEvent[i] = data[i].nbPlaceEvent;
                }
                ;
                $('#datepicker').datepicker("refresh");
            }, "json")
        }
    });

    function highlightDate(date) {
        for (var i = 0; i < dateEvent.length; i++) {
            if ($.datepicker.formatDate("yy-mm-dd", date) == dateEvent[i]) {
                if (nbPlaceEvent[i] == 0) {
                    return [false, "eventComplet"];
                }
                else {
                    return [true, "eventOk", typeEvent[i] + " : " + titreEvent[i] + " est disponible"];
                }
            }
        }
        return [false, ''];
    }

})