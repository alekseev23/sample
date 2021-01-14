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

namespace Work;

error_reporting(-1);
require '../../bootstrap.php';

$router = new \Work\Routers\Router();
$controllerName = $router->getController();
if ($controllerName != '') {
    $controller = new $controllerName();
    $controller->process();
    echo $controller->getResult();
}
