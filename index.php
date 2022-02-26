<?php

require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? '/')) . 'Controller';
// echo $controllerName; exit();

$actionName = $_REQUEST['action'] ?? 'index';
// echo $actionName; exit();

if ($controllerName[0] === '/') {
    $controllerName = 'SiteController';
    $actionName = 'login';
}

require "./Controllers/$controllerName.php";

$controllerObj = new $controllerName;
$controllerObj->$actionName();
