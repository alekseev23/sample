<?php
declare(strict_types=1);

namespace Work\Controllers;

error_reporting(-1);

use \Work\Interfaces\ResponseInterface;

class TaskController implements ResponseInterface
{
    private $res;

    public function process()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/index.php/api/v1/users/add', '\Work\Controllers\UserAdd');
            $r->addRoute('GET', '/index.php/api/v1/users/list', '\Work\Controllers\UserList');
            $r->addRoute('GET', '/index.php/api/v1/books/add', '\Work\Controllers\BookAdd');
            $r->addRoute('GET', '/index.php/api/v1/books/list', '\Work\Controllers\BookList');
        });

        //echo " REQUEST=";
        //var_dump($_REQUEST);

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
        $this->res = "";
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                echo "404 Not Found";
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo "Method not allowed";
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                // ... call $handler with $vars
                $this->res = $handler();
                break;
        }

    }

    public function getResult(): string
    {
        return json_encode($this->res);
    }
}
//-----------------------------------------------------------------------

function UserAdd():array
{
    if (!isset($_REQUEST['name']))
    {
        $res['result'] = 'error';
        $res['message'] = 'Variable [name] not found';
    } else {
        // Пробуем добавить нового пользователя
        try {
            $name = $_REQUEST['name'];
            $fields = ['name' => $name];
            $user = \Work\Models\User::create($fields);
            // Выводим сообщение и id пользователя
            $res['result'] = 'success';
            $res['message'] = 'User was added';
            $res['id'] = $user->id;
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $res['result'] = 'error';
            $res['message'] = $t->getMessage();
        }
    }
    return $res;
}

function UserList()
{
    if (isset($_REQUEST['name']))
    {
        // Use name for pattern
        $users = \Work\Models\User::where('name', 'like', $_REQUEST['name'])->get();
    }
    else {
        // Показать всех пользователей
        $users = \Work\Models\User::all();
    }
    return $users;
}

function BookAdd():array
{
    if (!isset($_REQUEST['name']))
    {
        $res['result'] = 'error';
        $res['message'] = 'Variable [name] not found';
    } else {
        // Пробуем добавить новую книгу
        try {
            $name = $_REQUEST['name'];
            $fields = ['name' => $_REQUEST['name'], 'author' => $_REQUEST['author'], 'publish_year' => $_REQUEST['publish_year'],
                'user_id' => $_REQUEST['user_id']];
            $book = \Work\Models\Book::create($fields);
            // Выводим сообщение и id пользователя
            $res['result'] = 'success';
            $res['message'] = 'Book was added';
            $res['id'] = $book->id;
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $res['result'] = 'error';
            $res['message'] = $t->getMessage();
        }
    }
    return $res;
}

function BookList()
{
    if (isset($_REQUEST['name']))
    {
        // Use name for pattern
        $books = \Work\Models\Book::where('name', 'like', $_REQUEST['name'])->get();
    }
    else {
        // Показать все книжки
        $books = \Work\Models\Book::all();
    }
    return $books;
}
