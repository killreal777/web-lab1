function disableAllRadiusCheckboxesExcept(callingCheckbox) {
    for (let checkbox of document.getElementsByClassName("radius_checkbox")) {
        if (checkbox.id !== callingCheckbox.id)
            checkbox.checked = false;
    }
}

function setX(value) {
    document.getElementById("x_value").value = value;
}

function validateForm() {
    return validateYValue();
}

function validateYValue() {
    let y = document.getElementById("y").value;
    alert(isNumeric(y));
}

function isNumeric(str) {
    return !isNaN(str) && !isNaN(parseFloat(str));
}

