let form = $("#user-request-form");
let initForm = $("#initial-request-form");
let clearForm = $("#clear-request-form");
let errMsg = $("#err-msg");


$.ajax({
    type: "GET",
    url: "script.php",
    data: initForm.serialize(),
    success: function(data) {
        $("#results-table-body").prepend(data);
    }
});

form.submit(function(event) {
    event.preventDefault();

    if (!isFormInputValid())
        return;

    submitForm();
});




function clearRequest() {
    $("#clear")
    $.ajax({
        type: "GET",
        url: "script.php",
        data: clearForm.serialize(),
        success: function() {
            $("#results-table-body").replaceWith("");
            location.reload();
        }
    });
}




function submitForm() {
    $.ajax({
        type: "GET",
        url: "script.php",
        data: form.serialize(),
        success: function(data) {
            let dataJson = JSON.parse(data);
            writeResult(dataJson);
            printDot(dataJson);
        }
    });
}

function writeResult(dataJson) {
    let tableRow = convertJsonToTablaRow(dataJson);
    $("#results-table-body").prepend(tableRow);
}

function convertJsonToTablaRow(json) {
    let tableRow = "";
    for (let key in json) {
        tableRow += ("<td>" + json[key] + "</td>");
    }
    tableRow = "<tr>" + tableRow + "</tr>";
    return tableRow;
}

function printDot(dataJson) {
    let rValue = dataJson["r"];
    let xValue = dataJson["x"];
    let yValue = dataJson["y"];
    let hitDot = $("#hit-dot");

    let centerCoordinate = 150;

    let dotOffsetX = getDotOffset(xValue, rValue);
    let dotOffsetY = getDotOffset(yValue, rValue);

    let dotCoordinateX = centerCoordinate + dotOffsetX;
    let dotCoordinateY = centerCoordinate - dotOffsetY;

    hitDot.attr("cx", dotCoordinateX);
    hitDot.attr("cy", dotCoordinateY);
}

function getDotOffset(coordinateValue, rValue) {
    let radiusOffset = 100;
    let maxOffset = 149.5;
    let minOffset = -149.5;

    let dotOffset = coordinateValue / rValue * radiusOffset;

    if (dotOffset > maxOffset)
        dotOffset = maxOffset;
    if (dotOffset < minOffset)
        dotOffset = minOffset;

    return dotOffset;
}


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
