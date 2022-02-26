<?php

require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'Welcome')) . 'Controller';
// echo $controllerName; exit();

$actionName = $_REQUEST['action'] ?? 'index';
// echo $actionName; exit();

require "./Controllers/$controllerName.php";

$controllerObj = new $controllerName;
$controllerObj->$actionName();