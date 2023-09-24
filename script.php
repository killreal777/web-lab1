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

echo encodeJson($currentTime, $scriptRunTime, $x, $y, $r, $isHit);


function currentTime(): string
{
    date_default_timezone_set('Europe/Moscow');
    $currentDateTime = new DateTime();
    return date('H:i:s', $currentDateTime->getTimestamp());
}


function encodeJson($currentTime, $scriptRunTime, $x, $y, $r, $isHit)
{
    $dataArray = array(
        "currentTime" => $currentTime,
        "scriptRunTime" => $scriptRunTime,
        "x" => $x,
        "y" => $y,
        "r" => $r,
        "isHit" => $isHit,
    );

    return json_encode($dataArray);
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
    return is_numeric($r) && $r > $min && $r < $max;
}

function isXValid($x): bool
{
    $min = -3; $max = 5;
    return is_numeric($x) && $x > $min && $x < $max;
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

