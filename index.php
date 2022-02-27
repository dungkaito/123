<?php

require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

/*   route: ?controller={controllerName}&action={action}   */

$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? '/')) . 'Controller';

$actionName = $_REQUEST['action'] ?? 'index';

if ($controllerName[0] === '/') {
    $controllerName = 'SiteController';
}

require "./Controllers/$controllerName.php";

$controllerObj = new $controllerName;
session_start();
$controllerObj->$actionName();
