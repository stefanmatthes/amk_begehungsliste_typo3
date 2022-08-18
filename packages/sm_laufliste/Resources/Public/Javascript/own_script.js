$('#rfidscan').click(function(){
    $('#rfid_input').focus();
});

$("form.jqControll").submit(function (event) {
    console.log("submit");
    event.preventDefault();
    var form = $(this);
    var action = form.attr("action"),
        method = form.attr("method"),
        data = form.serialize();

    $.ajax({
        url: action,
        type: method,
        data: data
    }).done(function (data) {
     //   $('form').remove();
        console.log(data);
        $('.formresult').html('<p>Vielen Dank für Deinen Kommentar. Dieser wird geprüft und in Kürze freigeschaltet.</p>')
    }).fail(function () {
        $('form').remove();
        $('.formresult').html('<p>Upps, es ist ein Fehler aufgetreten. Dein Kommentar konnte nicht gespeichert werden</p>')
    }).always(function () {

    });
});