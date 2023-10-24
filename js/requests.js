const form = $("#user-request-form");


const requests = {
    initialRequest : function() {
        $.ajax({
            type: "GET",
            url: "script.php",
            data: {"request-type" : "initial-request"},
            success: function(data) {
                $("#results-table-body").prepend(data);
            }
        });
    },

    clearRequest : function () {
        $.ajax({
            type: "GET",
            url: "script.php",
            data: {"request-type" : "clear-request"},
            success: function() {
                $("#results-table-body").replaceWith("");
                location.reload();
            }
        });
    },

    areaCheckRequest : function () {
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
}

export default requests;


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