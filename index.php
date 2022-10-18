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
    <tr>
        <td>
            <svg width="300" height="300">
                <!-- Оси координат -->
                <line x1="1" x2="300" y1="150" y2="150" ></line>
                <line x1="150" x2="150" y1="0" y2="300"></line>
                <!-- Стрелки к осям -->
                <polygon points="150,0 145,15 155,15" stroke="black"></polygon>
                <polygon points="300,150 285,145 285,155" stroke="black"></polygon>
                <!-- Метки для значений R на оси X -->
                <circle cx="50" cy="150" r="3" fill="black"></circle>
                <circle cx="100" cy="150" r="3" fill="black"></circle>
                <circle cx="150" cy="150" r="3" fill="black"></circle>
                <circle cx="200" cy="150" r="3" fill="black"></circle>
                <circle cx="250" cy="150" r="3" fill="black"></circle>
                <!-- Метки для значений R на оси Y -->
                <circle cx="150" cy="50" r="3" fill="black"></circle>
                <circle cx="150" cy="100" r="3" fill="black"></circle>
                <circle cx="150" cy="200" r="3" fill="black"></circle>
                <circle cx="150" cy="250" r="3" fill="black"></circle>
                <!-- Прямоугольник -->
                <polygon stroke="black" fill="blue" fill-opacity="0.2" points="200,150 200,250 150,250 150,150"></polygon>
                <!-- Треугольник -->
                <polygon stroke="black" fill="blue" fill-opacity="0.2" points="200,150 150,150 150,100"></polygon>
                <!-- Четверть эллипса -->
                <path stroke="black" fill="blue" fill-opacity="0.2" d="M50,150 A100,100 90 0,1 150,50 L 150,150 Z"></path>
                <!-- Подписи к осям -->
                <text x="285" y="140">X</text>
                <text x="160" y="15">Y</text>
                <!-- Значения R на оси X -->
                <text x="40" y="140">-R</text>
                <text x="85" y="140">-R/2</text>
                <text x="190" y="140">R/2</text>
                <text x="245" y="140">R</text>
                <!-- Значения R на оси Y -->
                <text x="160" y="52.5">R</text>
                <text x="160" y="102.5">R/2</text>
                <text x="160" y="202.5">-R/2</text>
                <text x="160" y="252.5">-R</text>

                <circle id="circle" cx="150" cy="150" r="3" fill="red" stroke-width="0"></circle>
            </svg>
        </td>
    </tr>
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