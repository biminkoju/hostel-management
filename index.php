<?php
$request = $_SERVER['REQUEST_URI'];

switch ((str_split($request, 18))[1]) {
    case "/":
    case "":
        require __DIR__ . "/home.php";

    default:
        http_response_code(404);
        require __DIR__ . "/pages/util/404.php";
        break;
}
?>