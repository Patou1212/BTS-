$(document).ready(function () {
    var dateEvent = [];
    var titreEvent = [];
    var nbPlaceEvent = [];
    var typeEvent = [];
    var nbParticipant = [];
    var currYear = '';
    var imax = 0;
    $('#titreEvent').hide();
    $('#personne').hide();
    $('#eventVide').hide();
    $('#titre').hide();
    $('#headTable').hide();
    $.get("eventJson.php", function (data) {
        for (var i = 0; i < data.length; i++) {
            dateEvent[i] = data[i].dateEvent;
            titreEvent[i] = data[i].titreEvent;
            nbPlaceEvent[i] = data[i].nbPlaceEvent;
            typeEvent[i] = data[i].libelleType;
            nbParticipant[i] = data[i].nbParticipant;
        }
        ;
        $("#datepickerAnnulation").datepicker("destroy");
        $("#datepickerAnnulation").datepicker(
            {
                prevText: 'Précédent',
                nextText: 'Suivant',
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                weekHeader: 'Sem.',
                dateFormat: 'yy-mm-dd',
                beforeShowDay: highlightDate,
                onSelect: function (dateChoisie, inst) {
                    $.get("eventJsonChange.php?dateChoisie=" + dateChoisie, function (data) {
                        imax = data.imax;
                        $('#eventVide').empty();
                        $('#tbody').empty();
                        $('#titre').show();
                        $('#titreEvent').show();
                        $('#headTable').show();
                        $('#titreEvent').empty();
                        $('#titreEvent').append(data.titreEvent);
                        for (var i = 0; i < data.personne.length; i++) {
                            $(data.personne[i]).appendTo('#tbody');
                        }
                        ;
                        if (!$(data.personne).length) {
                            $('#personne').hide();
                            $('#eventVide').show();
                            $('#eventVide').append('Cet évènement n\' a pas encore de participant');
                        }
                        else {
                            $('#personne').show();
                        }
                        /*$('#datepickerAnnulation').on('click', function () {
                         $('#eventVide').empty();
                         $('#tbody').empty();
                         $('#personne').hide();
                         $('#eventVide').hide();
                         $('#headTable').hide();
                         $('#titre').hide();
                         });*/
                        (function (i) {
                            for (var i = 0; i < imax; i++) {
                                $('#idPersonne' + i).on('click', function () {
                                    var id = $(this);
                                    //ouverture du modal de confirmation
                                    $("#myModal").modal();
                                    //Action effectuée après avoir confirmer la suppression dans le modal
                                    $("#modalConfirmAnnulation").on('click', function () {
                                        var idPersonne = $(id).attr('value');
                                        $(id).attr('id');
                                        var numRow = $(id).attr('id').match(/[0-9]/);
                                        $.get('eventJsonChange.php?idPersonne=' + idPersonne, function () {
                                            $('#tr' + numRow).remove();
                                            if ($('#tbody').find("tr").length === 0) {
                                                $('#personne').hide();
                                                $('#eventVide').show();
                                                $('#eventVide').append('Cet évènement n\' a pas encore de participant');
                                            }
                                            //fermeture du modal de confirmation
                                            $('#myModal').modal('toggle');
                                        })
                                    })
                                })
                            }
                            ;
                        })(i);
                    }, 'json');
                }
            });
        currYear = $(".ui-datepicker-year").html();
        $('#datepickerAnnulation').datepicker("refresh");
    }, "json");
    $("#datepickerAnnulation").on("click", function () {
        if ($('.ui-datepicker-year').html() != currYear) {
            currYear = $(".ui-datepicker-year").html();
            var dataSent = currYear;
            $.get("eventJson.php?dataSent=" + dataSent, function (data) {
                for (var i = 0; i < data.length; i++) {
                    dateEvent[i] = data[i].dateEvent;
                    titreEvent[i] = data[i].titreEvent;
                    nbPlaceEvent[i] = data[i].nbPlaceEvent;
                    nbParticipant[i] = data[i].nbParticipant;
                }
                ;
                $('#datepickerAnnulation').datepicker("refresh");
            }, "json")
        }
    })
    /*
     * Fonction qui rends cliquable les evènements du calendrier
     */
    function highlightDate(date) {
        for (var i = 0; i < dateEvent.length; i++) {
            if ($.datepicker.formatDate("yy-mm-dd", date) == dateEvent[i]) {
                if (nbParticipant[i] == 0) {
                    return [true, "eventAnnulation", typeEvent[i] + " : " + titreEvent[i] + " -- Nombre de places totales: " + nbPlaceEvent[i]];
                }
                else {
                    return [true, "eventAnnulation", typeEvent[i] + " : " + titreEvent[i] + " -- Nombre de places totales: " + nbPlaceEvent[i] + " -- Nombre de places achetées: " + nbParticipant[i]];
                }
            }
        }
        return [false, ''];
    }
})