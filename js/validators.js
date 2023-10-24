const errMsg = $("#err-msg");


const validators = {
    isFormInputValid : function() {
        return validators.isRInputValid() && validators.isXInputValid() && validators.isYInputValid();
    },

    isRInputValid : function() {
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
    },

    isXInputValid : function() {
        let x = $("#x").val();
        let min = -3, max = 5;

        if (!$.isNumeric(x)) {
            errMsg.html("Х должен быть числом типа Float");
            return false;
        }
        if (x <= min || x >= max) {
            errMsg.html("Х вне допустимого диапазона");
            return false;
        }
        errMsg.html("");
        return true;
    },

    isYInputValid : function () {
        if ($('input[name="y"]').is(':checked')) {
            errMsg.html("");
            return true;
        }
        errMsg.html("Введите Y");
        return false;
    }
}

export default validators;

