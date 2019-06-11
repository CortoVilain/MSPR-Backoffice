jQuery('.btn-ajout-pharmacie').click(function() {
    jQuery('.tr-ajout-pharmacie').css('display', 'block');
    jQuery('.tr-ajout-pharmacien').css('display', 'none');
});

jQuery('.btn-ajout-pharmacie-annuler').click(function() {
    jQuery('.tr-ajout-pharmacie').css('display', 'none');
});

jQuery('.btn-ajout-pharmacien').click(function() {
    jQuery('.tr-ajout-pharmacien').css('display', 'block');
    jQuery('.tr-ajout-pharmacie').css('display', 'none');
});

jQuery('.btn-ajout-pharmacien-annuler').click(function() {
    jQuery('.tr-ajout-pharmacien').css('display', 'none');
});