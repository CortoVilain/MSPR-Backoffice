jQuery('.btn-ajout-visite').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'block');
    jQuery('.tr-ajout-questionnaire').css('display', 'none');
});

jQuery('.btn-ajout-visite-annuler').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'none');
});

jQuery('.btn-ajout-questionnaire').click(function() {
    jQuery('.tr-ajout-questionnaire').css('display', 'block');
    jQuery('.tr-ajout-visite').css('display', 'none');
});

jQuery('.btn-ajout-questionnaire-annuler').click(function() {
    jQuery('.tr-ajout-questionnaire').css('display', 'none');
});