let form = $("form");
let formRedirectButton = $("#form-redirect-button");
let errMsg = $("#err-msg");

function redirectToForm() {
    window.location.replace("index.html");
}


formRedirectButton.click(redirectToForm);

form.on('submit', function (event) {
    if (!isFormInputValid())
        event.preventDefault();
});


function isFormInputValid() {
    return isRInputValid() && isXInputValid() && isYInputValid();
}


function isRInputValid() {
    let r = $("#r").val();
    let min = 2, max = 5;

    if (!$.isNumeric(r)) {
        errMsg.html("Радиус должен быть числом типа Float");
        return false;
    }
    if (r <= min || r >= max) {
        errMsg.html("Радиус вне допустимого диапазона");
        return false;
    }
    errMsg.html("");
    return true;
}

function isXInputValid() {
    let x = $("#x").val();
    let min = -3, max = 5;

    if (isNotNumeric(x)) {
        errMsg.html("Х должен быть числом типа Float");
        return false;
    }
    if (x <= min || x >= max) {
        errMsg.html("Х вне допустимого диапазона");
        return false;
    }
    errMsg.html("");
    return true;
}

function isYInputValid() {
    if ($('input[name="y"]').is(':checked')) {
        errMsg.html("");
        return true;
    }
    errMsg.html("Введите Y");
    return false;
}


function isNotNumeric(value) {
    return isNaN(parseFloat(value));
}
