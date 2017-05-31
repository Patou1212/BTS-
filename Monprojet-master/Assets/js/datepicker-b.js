$(document).ready(function () {

    //array of dates from database MySql
    var eventDates   = [];

    //array of title of the event
    var eventTitre   = [];

    //array of type of event
    var eventLibelle = [];

    $.ajax({
        url:"../Controllers/EventDatePicker.php",
        dataType:"json",
        async:false,
        success:
            function (data) {
            for (var i = 0; i < data.length; i++) {
                var formatDate = data[i].dateEvent;
                if (formatDate) {
                    formatDate = formatDate.replace(/(\d{4})-(\d{1,2})-(\d{1,2})/, function (match, y, m, d) {
                        return m + '/' + d + '/' + y; //conversion yy-mm-dd => mm/dd/yy
                    });
                }
                eventDates[i]   = formatDate;
                eventTitre[i]   = data[i].titreEvent;
                eventLibelle[i] = data[i].libelleType;
            }
        }

    });
var messageEventOk = 'Ce jour est disponible. Vous pouvez créer un evenement ce jour la';

var messageTooMuchEvent = "Il y a deja un evenement ce jour la. Le programme ne permet d'avoir qu'un seul evenement par jour !" ;

$("#datepicker").datepicker({
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd', 
    beforeShowDay: showDate,
    onSelect: function(dateText, inst) {
            //window.location = 'http://mysite/events/Pages/default.aspx?dt=' + dateText;
                    $('#inputDate').val(dateText);
        },
    });

    function showDate(date) {
        for (var i = 0; i < eventDates.length; i++) {

            if (new Date(eventDates[i]).toString() == date.toString()) {
                    return [true, 'eventNonDispo ui-datepicker-unselectable','JOUR RESERVÉ -- ' +eventLibelle[i] +' : ' + eventTitre[i]];
            }
        }
        return [true, 'eventDispo',messageEventOk];
    }

});
