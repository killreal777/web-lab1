import requests from "./requests.js";
import validators from "./validators.js";

const form = $("#user-request-form");


requests.initialRequest();

form.submit(function(event) {
    event.preventDefault();

    if (!validators.isFormInputValid())
        return;

    requests.areaCheckRequest();
});

$("#clear").on('click', function () {
    requests.clearRequest();
})