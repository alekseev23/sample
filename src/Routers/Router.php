<?php
declare(strict_types=1);

namespace Work\Routers;

/**
 * Находим контроллер для заданных маршрутов
 * @package Work\Routers
 */
class Router
{
    /**
     * @return string
     */
    public function getController(): string
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/index.php/api/v1/users/add', '\Work\Controllers\UserAdd');
            $r->addRoute('GET', '/index.php/api/v1/users/list', '\Work\Controllers\UserList');
            $r->addRoute('GET', '/index.php/api/v1/books/add', '\Work\Controllers\BookAdd');
            $r->addRoute('GET', '/index.php/api/v1/books/list', '\Work\Controllers\BookList');
            $r->addRoute('GET', '/index.php/api/v1/ruble', '\Work\Controllers\ExchangeRates');

            $r->addRoute('GET', '/index.php/api/v1/convert/timestamp2datetime', '\Work\Controllers\Timestamp2Datetime');
            $r->addRoute('GET', '/index.php/api/v1/convert/datetime2timestamp', '\Work\Controllers\Datetime2Timestamp');
            $r->addRoute('GET', '/index.php/api/v1/convert/datetime2date', '\Work\Controllers\Datetime2Date');
        });
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                return '\Work\Controllers\NotFound';
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                return '\Work\Controllers\NotAllowed';
            case \FastRoute\Dispatcher::FOUND:
                return $routeInfo[1];
        }
        return '\Work\Controllers\NotFound';
    }
}
