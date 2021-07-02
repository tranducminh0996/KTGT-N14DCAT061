window.showMessage = function showMessage(message, context) {
    $('div.alert').show();
    $('div.alert').addClass(`alert-${context}`);
    $('div.alert').html(message)
        .delay(3500).fadeOut(350);
}

