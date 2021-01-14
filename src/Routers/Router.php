<?php
declare(strict_types=1);

namespace Work\Routers;

error_reporting(-1);

use \Work\Interfaces\ResponseInterface;

class Router
{

    public function getController():string
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/index.php/api/v1/users/add', '\Work\Controllers\UserAdd');
            $r->addRoute('GET', '/index.php/api/v1/users/list', '\Work\Controllers\UserList');
            $r->addRoute('GET', '/index.php/api/v1/books/add', '\Work\Controllers\BookAdd');
            $r->addRoute('GET', '/index.php/api/v1/books/list', '\Work\Controllers\BookList');
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        //echo " uri=".$uri." ";

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                echo "404 Not Found";
                return '';
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo "Method not allowed";
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                return '';
                break;
            case \FastRoute\Dispatcher::FOUND:
                // ... call $handler with $vars
                return $routeInfo[1];
        }

    }
}
