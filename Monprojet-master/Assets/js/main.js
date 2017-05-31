/**
 * Created by Michel on 10/10/2016.
 */
$(document).ready(function () {
    // Fonction qui permet de mettre en majuscule la première lettre
    String.prototype.Majuscule = function () {

        return this.toLowerCase().replace(/(^|\s|\-)([a-zéèêë])/g, function (u, v, w) {
            return v + w.toUpperCase()
        });
    }

    //Fonction qui permet d'afficher/masquer la div du plan dans le backOffice (créationEvent)
    $('.salle2').hide();
    $('.salle1').hide();



    $('#TypeSalle').change(function () {
        var valueSelected = $(this).val();
        switch (valueSelected) {
            case '1':
                $('.salle1').show();
                $('.salle2').hide();
                break;
            case '2':
                $('.salle2').show();
                $('.salle1').hide();
                break;
            default:
                null;
        }
    });
});