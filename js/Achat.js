jQuery('.btn-ajout').click(function() {
    jQuery('.tr-ajout').css('display', 'block');
});

jQuery('.btn-ajout-annuler').click(function() {
    jQuery('.tr-ajout').css('display', 'none');
});

jQuery('.btn-ajout-vente').click(function() {
    jQuery('.tr-ajout-vente').css('display', 'block');
});

jQuery('.btn-ajout-vente-annuler').click(function() {
    jQuery('.tr-ajout-vente').css('display', 'none');
});

jQuery('.btn-ajout-formation').click(function() {
    jQuery('.tr-ajout-association').css('display', 'none');
    jQuery('.tr-ajout-formation').css('display', 'block');
});

jQuery('.btn-ajout-formation-annuler').click(function() {
    jQuery('.tr-ajout-formation').css('display', 'none');
});

jQuery('.btn-association-formation').click(function() {
    jQuery('.tr-ajout-formation').css('display', 'none');
    jQuery('.tr-ajout-association').css('display', 'block');
});

jQuery('.association-annuler').click(function() {
    jQuery('.tr-ajout-association').css('display', 'none');
});

jQuery('.btn-ajout-produit').click(function() {
    jQuery('.tr-ajout-produit').css('display', 'none');
    jQuery('.tr-ajout-produit').css('display', 'block');
});

jQuery('.btn-ajout-produit-annuler').click(function() {
    jQuery('.tr-ajout-produit').css('display', 'none');
});