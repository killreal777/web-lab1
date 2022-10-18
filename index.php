<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web lab1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table id="header_table" class="main_table">
    <tr><td class="header">К.Кравцов P32101 вариант 1310</td></tr>
    <tr><td><img src="areas.png" width="420" alt="areas"></td></tr>
</table>


<form id="form" class="form" action="script.php" method="get">
    <table id="form_table">
        <tr><td><label for="radius_checkboxes">Радиус R</label></td></tr>
        <tr>
            <td id="radius_checkboxes">
                <?php for ($value = 1; $value <= 3; $value += 0.5)
                    echo "<input id='r_$value' class='radius_checkbox' type='checkbox' name='r' value='$value'/>
                          <label for='r_$value'>$value</label>" ?>
            </td>
        </tr>

        <tr><td><label for="x_value">Координата X</label></td></tr>
        <tr>
            <td><input id="x_value" name="x" type="number" value="0" readonly></td>
            <td id="x_buttons">
                <?php for ($value = -3; $value <= 5; $value++)
                    echo "<input class='x_button' type='button' value='$value'>" ?>
            </td>
        </tr>

        <tr><td><label for="y">Координата Y</label></td></tr>
        <tr><td><input id="y" class="y" name="y" type="text" required=""></td></tr>

        <tr><td><input id="submit" type="button" value="Отправить"></td></tr>
    </table>
</form>

<table id="results_table" class="main_table">
    <thead>
        <tr id="results_table_head">
            <td>Время</td><td>Затраты</td><td>X</td><td>Y</td><td>R</td><td>Результат</td>
        </tr>
    </thead>
    <tbody id="result_table_body" class="result_table_body"></tbody>
</table>
</body>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="validate-form.js"></script>
<script src="configure-form.js"></script>

</html>