jQuery('.btn-ajout-visite').click(function() {
    jQuery('.tr-ajout-questionnaire').css('display', 'none');
    jQuery('.tr-ajout-visite').css('display', 'block');
});

jQuery('.btn-ajout-visite-annuler').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'none');
});

jQuery('.btn-ajout-questionnaire').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'none');
    jQuery('.tr-ajout-questionnaire').css('display', 'block');
});

jQuery('.btn-ajout-questionnaire-annuler').click(function() {
    jQuery('.tr-ajout-questionnaire').css('display', 'none');
});


jQuery('#multiple').click(function() {
    if($('#multiple').is(':checked')) {
        jQuery('#idTd').empty();
        jQuery('#idTd').append('<input type="text" class="form-control">\n' +
            '    <input type="text" class="form-control">\n' +
            '<button type="button" class="btn btn-outline-dark btn-sm btn-rep">+</button>' +
            '<button type="button" class="btn btn-outline-danger btn-sm btn-sup" style="display: none">−</button>');
    }
    jQuery('.btn-rep').click(function() {
        jQuery('.btn-rep').before('  <input type="text" class="form-control reponse">');

        $('.reponse').attr("id","input");
        jQuery('.btn-sup').css('display', 'inline-block');
    });
    jQuery('.btn-sup').click(function () {
        jQuery('#input').remove();
    });
});

jQuery('#libre').click(function() {
    if($('#libre').is(':checked')) {
        jQuery('#idTd').empty();
        jQuery('#idTd').append('<textarea class="form-control" rows="1" disabled> Réponse libre</textarea>');
    }
});


jQuery('#ajouter-question').click(function() {
    jQuery('#question').clone().appendTo('#form');
});

