<?php
declare(strict_types=1);

require '../../bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    //$r->addRoute('GET', '/public/index.php/api/v1/index', 'TaskController@index');

    $r->addRoute('GET', '/public/index.php/api/v1/users/add', 'add_user');
    $r->addRoute('GET', '/public/index.php/api/v1/users/list', 'list_users');
    $r->addRoute('GET', '/public/index.php/api/v1/books/add', 'add_book');
    $r->addRoute('GET', '/public/index.php/api/v1/books/list', 'list_books');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    // Make vars array
    $s = substr($uri, $pos+1);
    $b = explode('&', $s);
    foreach ($b as $bb) {
        $c=explode('=',$bb);
        $vars[$c[0]] = $c[1];
    }

    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
//echo " uri=".$uri." ";
//echo " GET=";
//var_dump($_GET);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
$res = "";
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "case 1 ";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "case 2 ";
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        //echo 'Help me again!';
        $handler = $routeInfo[1];
        //$vars = $routeInfo[2];

        //echo " vars=";
        //var_dump($vars);
        // ... call $handler with $vars
        $res = $handler($vars);
        break;
}

echo $res;

//-----------------------------------------------------------------------

function add_user($vars) {
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
    return(json_encode($res));
}

function list_users() {
//    users = \Work\Models\User::where('name', 'like', $pattern)->get();
    // Показать всех пользователей
    $users = \Work\Models\User::all();
    return(json_encode($users));
}

function add_book($vars) {
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
    return(json_encode($res));
}

function list_books() {
    // Показать всех пользователей
    $books = \Work\Models\Book::all();
    return(json_encode($books));
}
