jQuery('.btn-ajout-visite').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'block');
});

jQuery('.btn-ajout-visite-annuler').click(function() {
    jQuery('.tr-ajout-visite').css('display', 'none');
});


jQuery('#simple').click(function() {
    jQuery('#idTd').append('\n' +
        '                        <div class="form-check radio" id="radio">\n' +
        '                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>\n' +
        '                            <input type="text" class="form-control form-control-sm">\n' +
        '                        </div>');
    jQuery('#multiple').prop('disabled',true);
    jQuery('#libre').prop('disabled',true);
});
jQuery('#multiple').click(function() {
    jQuery('#idTd').append('<div class="input-group" id="checkbox">\n' +
        '                            <div class="input-group-prepend">\n' +
        '                                <div class="input-group-text">\n' +
        '                                    <input type="checkbox">\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <input type="text" class="form-control">\n' +
        '                        </div>');
    jQuery('#simple').prop('disabled',true);
    jQuery('#libre').prop('disabled',true);
});
jQuery('#libre').click(function() {
    jQuery('#idTd').append('<textarea class="form-control" rows="1" id="textarea" name="question"></textarea>');
    jQuery('#simple').prop('disabled',true);
    jQuery('#multiple').prop('disabled',true);
    jQuery('#libre').prop('disabled',true);
});

jQuery('#form').submit(function(event) {
    event.preventDefault();
    jQuery('#reponse').append('<table>\n' +
        '                <tr>\n' +
        '                    <td>Question</td>\n' +
        '                    <td>Type de question</td>\n' +
        '                    <td>Réponse</td>\n' +
        '                </tr>\n' +
        '                <tr>\n' +
        '                <form class="form-ajout-visite" method="post" action="Visites.php" id="form">\n' +
        '                    <td><textarea class="form-control" rows="1"  name="question"></textarea></td>\n' +
        '                    <td>\n' +
        '                        <div class="input-group">\n' +
        '                            <div class="input-group-prepend">\n' +
        '                                <button class="btn btn-outline-secondary" type="button" id="simple">Simple</button>\n' +
        '                                <button class="btn btn-outline-secondary" type="button" id="multiple">Multiple</button>\n' +
        '                                <button class="btn btn-outline-secondary" type="button" id="libre">Libre</button>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </td>\n' +
        '                    <td id="idTd">\n' +
        '\n' +
        '                    </td>\n' +
        '                    <td><input class="btn btn-success" type="submit" name="ajouter-formulaire" value="Ajouter"  id="ajouter"/></td>\n' +
        '                </form>\n' +
        '                </tr>\n' +
        '            </table>');
});