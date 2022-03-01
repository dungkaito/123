<?php

require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

/*   route: ?controller={controllerName}&action={actionName}   */

$controllerList = ['Site', 'User', 'Message', 'Classwork'];

$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? '/'));

$actionName = $_REQUEST['action'] ?? 'index';

if ($controllerName === '/') {
    $controllerName = 'Site';
}

if (in_array($controllerName, $controllerList)) {

    require_once "./Controllers/{$controllerName}Controller.php";

    if (!method_exists($controllerName.'Controller', $actionName)) {
        $controllerName = 'Site';
        $actionName = 'error';
    }

} else {
    $controllerName = 'Site';
    $actionName = 'error';
}

$controllerName = $controllerName . 'Controller';
require_once "./Controllers/{$controllerName}.php";
$controllerObj = new $controllerName;
session_start();
$controllerObj->$actionName();
