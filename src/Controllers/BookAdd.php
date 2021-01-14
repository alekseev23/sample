<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Models\Book;


class BookAdd implements ResponseInterface
{

    private $res;

    public function process():int
    {
        if (isset($_REQUEST['name']))
        {
            // Пробуем добавить новую книгу
            try {
                $name = $_REQUEST['name'];
                $fields = ['name' => $_REQUEST['name'], 'author' => $_REQUEST['author'], 'publish_year' => $_REQUEST['publish_year'],
                    'user_id' => $_REQUEST['user_id']];
                $book = \Work\Models\Book::create($fields);
                // Выводим сообщение и id пользователя
                $this->res['result'] = 'success';
                $this->res['message'] = 'Book was added';
                $this->res['id'] = $book->id;
                return 0;
            }
            catch (Throwable $t) { // Если есть проблема, то ругаемся
                $this->res['result'] = 'error';
                $this->res['message'] = $t->getMessage();
                return -2;
            }
        }
        $this->res['result'] = 'error';
        $this->res['message'] = 'Variable [name] not found';
        return -1;
    }

    public function getResult():string
    {
        return json_encode($this->res);
    }

}
