<?php
declare(strict_types=1);

use FastRoute;
use ResponseInterface;

class TaskController
    implements ResponseInterface
{
    public $res;

    public function process()
    {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            /*$r->addRoute('GET', '/public/index.php/api/v1/users/add', 'UserAdd');
            $r->addRoute('GET', '/public/index.php/api/v1/users/list', 'UserList');
            $r->addRoute('GET', '/public/index.php/api/v1/books/add', 'BookAdd');
            $r->addRoute('GET', '/public/index.php/api/v1/books/list', 'BookList');*/
            $r->addRoute('GET', '/index.php/api/v1/users/add', 'UserAdd');
            $r->addRoute('GET', '/index.php/api/v1/users/list', 'UserList');
            $r->addRoute('GET', '/index.php/api/v1/books/add', 'BookAdd');
            $r->addRoute('GET', '/index.php/api/v1/books/list', 'BookList');
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            // Make vars array
            $s = substr($uri, $pos + 1);
            $b = explode('&', $s);
            foreach ($b as $bb) {
                $c = explode('=', $bb);
                $vars[$c[0]] = $c[1];
            }

            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        //echo " uri=".$uri." ";

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        $this->res = "";
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                echo "404 Not Found";
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo "Method not allowed";
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                //$vars = $routeInfo[2];
                //echo " vars=";
                //var_dump($vars);
                // ... call $handler with $vars
                $this->res = $handler($vars);
                break;
        }

    }

    public function getResult(): string
    {
        return (json_encode($this->res));
    }
}
//-----------------------------------------------------------------------

function UserAdd($vars):array {
    if (!isset($vars['name']))
    {
        $res['result'] = 'error';
        $res['message'] = 'Variable [name] not found';
    } else {
        // Пробуем добавить нового пользователя
        try {
            $name = $vars['name'];
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
    return($res);
}

function UserList($vars) {
    if (isset($vars['name']))
    {
        // Use name for pattern
        $users = \Work\Models\User::where('name', 'like', $vars['name'])->get();
    }
    else {
        // Показать всех пользователей
        $users = \Work\Models\User::all();
    }
    return($users);
}

function BookAdd($vars):array {
    if (!isset($vars['name']))
    {
        $res['result'] = 'error';
        $res['message'] = 'Variable [name] not found';
    } else {
        // Пробуем добавить новую книгу
        try {
            $name = $vars['name'];
            $fields = ['name' => $vars['name'], 'author' => $vars['author'], 'publish_year' => $vars['publish_year'],
                'user_id' => $vars['user_id']];
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
    return($res);
}

function BookList($vars) {
    if (isset($vars['name']))
    {
        // Use name for pattern
        $books = \Work\Models\Book::where('name', 'like', $vars['name'])->get();
    }
    else {
        // Показать все книжки
        $books = \Work\Models\Book::all();
    }
    return($books);
}
