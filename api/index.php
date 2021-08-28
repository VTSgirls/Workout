<?php
require_once '../mvc/controller.php';

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$controller = new Controller();

switch ($_REQUEST["type"]) {
    case 'coach':
        switch ($_REQUEST["status"]) {
            case 'update':
                echo $controller->rateCoach($_REQUEST["data"]);
                break;
            case 'block':
                echo $controller->block($_REQUEST["data"],"coach");
                break;
            };
        break;
    case 'category':
        switch ($_REQUEST["status"]) {
            case 'update':
                echo $controller->updateCategory($_REQUEST["data"]);
                break;
            case 'delete':
                echo $controller->deleteCategory($_REQUEST["data"]);
                break;
            case 'create':
                echo $controller->createCategory($_GET["data"]);
                break;
            };
        break;
    case 'user':
        switch ($_REQUEST["status"]) {
            case 'update':
                echo $controller->updateUser($_REQUEST["data"]);
                break;
            case 'block':
                echo $controller->block($_REQUEST["data"],"user");
                break;
            };
        break;
    case 'exercise':
        switch ($_REQUEST["status"]) {
            case 'delete':
                echo $controller->deleteExercise($_REQUEST["data"]);
                break;
            case 'block':
                echo $controller->block($_REQUEST["data"],"exercise");
            break;  
            case 'create':
                echo $controller->createExercise($_REQUEST["data"]);
                break;
            case 'update':
                echo $controller->updateExercise($_REQUEST["data"]);
                break;
            };
        break;
    default:
        break;
}

?>