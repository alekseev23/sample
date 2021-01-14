<?php
declare(strict_types=1);

namespace Work;

error_reporting(-1);
require '../../bootstrap.php';

$router = new \Work\Routers\Router();
$controllerName = $router->getController();
echo $controllerName;
if ($controllerName != '') {
    $controller = new $controllerName();
    $controller->process();
    echo $controller->getResult();
}
