<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Response\Data;
use \Work\Response\Error;
use \Work\Response\Success;
use \Work\Models\Book;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
class BookAdd implements ControllerInterface
{
    private $res,$Request;

    public function setRequestParameters(array $request): void
    {
        $this->Request=$request;
    }

    public function process(): ResponseInterface
    {
        if (!isset($this->Request['name'])) {
            $response=new \Work\Response\Error();
            $response->setMessage('Variable [name] not found');
            return($response);
        }
        // Пробуем добавить новую книгу
        try {
            $name = $this->Request['name'];
            $fields = [
                'name' => $this->Request['name'],
                'author' => $this->Request['author'],
                'publish_year' => $this->Request['publish_year'],
                'user_id' => $this->Request['user_id'],
                ];
            $book = \Work\Models\Book::create($fields);
            // Выводим сообщение и id пользователя
            $response=new \Work\Response\Success();
            $response->setMessage('Book was added',$book->id);
            return($response);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response=new \Work\Response\Error();
            $response->setMessage($t->getMessage());
            return($response);
        }
    }

    public function getResult():string
    {
        return json_encode($this->res);
    }
}
