<?php
/**
 * About file
 *
 * @author    Alexander Alekseev <alekseev_ap@mail.ru>
 * @copyright 2021 Noname
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @cathegory cathegory
 * @package package
 * @link http://www.nix.ru
 *
 */
declare(strict_types=1);

require '../../bootstrap.php';

$router = new \Work\Routers\Router();
$controllerName = $router->getController();
$controller = new $controllerName($_REQUEST);
//$controller->setDispatcher($dispatcher);
$controller->setRedisHandle($redis);
$response = $controller->process();
http_response_code($response->getCode());
echo $response->getResult();
