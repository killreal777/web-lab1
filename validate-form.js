function validateForm() {
    return validateYInput() && validateRInput();
}

function validateRInput() {
    if (isAnyRadiusCheckboxChecked())
        return true
    alert("radius is invalid");
    return false;
}

function isAnyRadiusCheckboxChecked() {
    let isAnyCheckboxChecked = false;
    for (let checkbox of document.getElementsByClassName("radius_checkbox"))
        isAnyCheckboxChecked = checkbox.checked || isAnyCheckboxChecked;
    return isAnyCheckboxChecked;
}

function validateYInput() {
    let y_input = document.getElementById("y");
    if (isYValid(y_input.value))
        return true;
    alert("y is invalid");
    return false;
}

function isYValid(y) {
    return isNumeric(y) && isValueInRange(y, -5, 5);
}

function isNumeric(value) {
    return !isNaN(value) && !isNaN(parseFloat(value));
}

function isValueInRange(value, min, max) {
    return (value >= min) && (value <= max);
}
