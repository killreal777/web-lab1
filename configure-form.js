let form = $("#form");
let radiusCheckboxes = $(".radius_checkbox");
let xButtons = $(".x_button");
let xValue = $("#x_value");
let submitButton = $("#submit");

// configure radius checkboxes
radiusCheckboxes.click(function () {
    for (let checkbox of radiusCheckboxes) {
        if (checkbox.id !== this.id)
            checkbox.checked = false;
    }
});

// configure x buttons
xButtons.click(function () {
    xValue.val(this.value)
});

// configure submit button
submitButton.click(function () {
    form.submit();
});

// configure form itself
form.submit(function (event) {
    console.log("submit");
    event.preventDefault();
    if (validateForm()) {
        sendForm();
    }
});

function sendForm() {
    alert(form.serialize());
    $.ajax({
        url: "script.php",
        method: "POST",
        data: form.serialize(),
        success: function (data) {
            $("#result_table_body").prepend(data);
        }
    });
}
