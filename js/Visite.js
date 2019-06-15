jQuery('.btn-ajout-visite').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'block');
});

jQuery('.btn-ajout-visite-annuler').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'none');
});


jQuery('#simple').click(function() {
    if($('#simple').is(':checked')) {
        jQuery('#idTd').empty();
        jQuery('#idTd').append('<div class="input-group">\n' +
            '                       <input type="text" class="form-control">\n' +
            '                       <div class="input-group-append">\n' +
            '                           <button class="btn btn-outline-secondary" type="button">\n' +
            '                               <span aria-hidden="true">x</span>\n' +
            '                           </button>\n' +
            '                       </div>\n' +
            '                   </div>' +
            '<div class="input-group" id="2">\n' +
            '    <input type="text" class="form-control">\n' +
            '    <div class="input-group-append">\n' +
            '        <button class="btn btn-outline-secondary" type="button">\n' +
            '            <span aria-hidden="true">x</span>\n' +
            '        </button>\n' +
            '    </div>\n' +
            '</div>' +
            '<button type="button" class="btn btn-outline-dark btn-sm btn-rep">Ajouter</button>');
    }
    jQuery('.btn-rep').click(function() {
        var x = $('#2').attr("id");
        x = x + 1;
        alert('x');
        jQuery('.btn-rep').before('<div class="input-group"> \n' +
            '                                   <input type="text" class="form-control"> \n' +
            '                                   <div class="input-group-append"> \n' +
            '                                       <button class="btn btn-outline-secondary" type="button" id=""> \n' +
            '                                           <span aria-hidden="true">x</span> \n' +
            '                                       </button> \n' +
            '                                   </div> \n' +
            '                               </div>');
    });
    jQuery('.$compteur').click(function() {
        jQuery('.input-group').empty();
    });
});


jQuery('#multiple').click(function() {
    if($('#multiple').is(':checked')) {
        jQuery('#idTd').empty();
        jQuery('#idTd').append('<div class="input-group">\n' +
            '                       <input type="text" class="form-control">\n' +
            '                       <div class="input-group-append">\n' +
            '                           <button class="btn btn-outline-secondary" type="button">\n' +
            '                               <span aria-hidden="true">x</span>\n' +
            '                           </button>\n' +
            '                       </div>\n' +
            '                   </div>' +
            '<div class="input-group">\n' +
            '    <input type="text" class="form-control">\n' +
            '    <div class="input-group-append">\n' +
            '        <button class="btn btn-outline-secondary" type="button">\n' +
            '            <span aria-hidden="true">x</span>\n' +
            '        </button>\n' +
            '    </div>\n' +
            '</div>' +
            '<button type="button" class="btn btn-outline-dark btn-sm btn-rep">Ajouter</button>');
    }
    jQuery('.btn-rep').click(function() {
        jQuery('.btn-rep').before('<div class="input-group"> \n' +
            '                                   <input type="text" class="form-control"> \n' +
            '                                   <div class="input-group-append"> \n' +
            '                                       <button class="btn btn-outline-secondary" type="button"> \n' +
            '                                           <span aria-hidden="true">x</span> \n' +
            '                                       </button> \n' +
            '                                   </div> \n' +
            '                               </div>');
    });
});

jQuery('#libre').click(function() {
    if($('#libre').is(':checked')) {
        jQuery('#idTd').empty();
        jQuery('#idTd').append('<textarea class="form-control" rows="1" disabled> Réponse libre</textarea>');
    }
});




$(document).ready(function(){
    $("#ajouter").click(function(event){
        event.preventDefault();
    });
});


/* exemple
jQuery('#simple').click(function() {
    jQuery('#idTd').append('\n' +
        '                        <div class="form-check radio" id="radio">\n' +
        '                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>\n' +
        '                            <input type="text" class="form-control form-control-sm">\n' +
        '                        </div>');
    jQuery('#multiple').prop('disabled',true);
    jQuery('#libre').prop('disabled',true);
});*/