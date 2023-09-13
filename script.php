<?php

$startTime = hrtime(true);

validateRequest();

$r = $_GET["r"];
$x = $_GET["x"];
$y = $_GET["y"];

$y = str_ireplace(",", ".", $y);

$currentTime = currentTime();
$isHit = isHit($r, $x, $y) ? "Попал" : "Мимо";
$scriptRunTime = (hrtime(true) - $startTime) / 1000000;

$resultTableRow = createHtmlTableRow($currentTime, $scriptRunTime, $x, $y, $r, $isHit);

if (isset($_COOKIE["resultsArray"])) {
    $resultsArray = json_decode($_COOKIE["resultsArray"], true);
}
$resultsArray[] = $resultTableRow;
setcookie("resultsArray", json_encode($resultsArray));


function currentTime(): string
{
    date_default_timezone_set('Europe/Moscow');
    $currentDateTime = new DateTime();
    return date('H:i:s', $currentDateTime->getTimestamp());
}


function createHtmlTableRow($currentTime, $scriptRunTime, $x, $y, $r, $isHit): string
{
    return "<tr><td>$currentTime</td><td>$scriptRunTime</td><td>$x</td><td>$y</td><td>$r</td><td>$isHit</td></tr>";
}


function validateRequest(): void
{
    validateHttpMethod();
    validateInput();
}

function validateHttpMethod(): void
{
    if (!isHttpMethodValid()) {
        echo "Ожидался метод GET";
        exit();
    }
}

function isHttpMethodValid(): bool
{
    return $_SERVER["REQUEST_METHOD"] == "GET";
}

function validateInput(): void
{
    if (!isInputValid()) {
        echo "На сервер пришли невалидные данные";
        exit();
    }
}

function isInputValid(): bool
{
    return isRValid($_GET["r"]) && isXValid($_GET["x"]) && isYValid($_GET["y"]);
}


function isRValid($r): bool
{
    $min = 2; $max = 5;
    return is_numeric($r) && $r >= $min && $r <= $max;
}

function isXValid($x): bool
{
    $min = -3; $max = 5;
    return is_numeric($x) && $x >= $min && $x <= $max;
}

function isYValid($y): bool
{
    $validOptions = range(-3, 5);
    return is_numeric($y) && in_array($y, $validOptions);
}


function isHit($r, $x, $y): bool
{
    return isHitQuarterCircle($r, $x, $y) || isHitTriangle($r, $x, $y) || isHitRectangle($r, $x, $y);
}

function isHitQuarterCircle($r, $x, $y): bool
{
    return ($x <= 0) && ($y >= 0) && ($x**2 + $y**2 <= $r**2);
}

function isHitTriangle($r, $x, $y): bool
{
    return ($x >= 0) && ($y <= 0) && ($y >= $x - $r/2);
}

function isHitRectangle($r, $x, $y): bool
{
    return ($x <= 0) && ($x >= -$r) && ($y <= 0) && ($y >= -$r/2);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web1 Results</title>
    <style>
        html {
            color: #222222;
            background-color: #EEEEEE;
            text-align: center;
            font-family: "Segoe UI", serif;
            font-size: 20pt;
        }
        table {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Время</td>
        <td>Затраты, ms</td>
        <td>X</td>
        <td>Y</td>
        <td>R</td>
        <td>Результат</td>
    </tr>
    </thead>
    <tbody>
        <?php foreach (array_reverse($resultsArray) as $row) echo $row ?>
    </tbody>
</table>
</body>

</html>
