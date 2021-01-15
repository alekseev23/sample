<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Response\Error;
use \Work\Response\Success;
use \Work\Models\Book;
use \Work\Models\User;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
class BookAdd extends BaseController implements ControllerInterface
{

    public function process(): ResponseInterface
    {
        // Проверка ID пользователя
        if (!isset($this->request['user_id'])) {
            $response = new Error('Variable [user_id] not found');
            return $response;
        }
        try {
            if (User::where('id', '=', $this->request['user_id'])->count() == 0) {
                $response = new Error("No user with user_id = {$this->request['user_id']}");
                return $response;
            }
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error($t->getMessage());
            return $response;
        }
        // Проверка года книги
        $publish_year = intval($this->request['publish_year']);
        if (($publish_year<1900) || ($publish_year>2020)) {
            $response = new Error('Странный год публикации книги');
            return $response;
        }
        // оверка названия книги
        if (!isset($this->request['name'])) {
            $response = new Error('Variable [name] not found');
            return $response;
        }
        // Пробуем добавить новую книгу
        try {
            $fields = [
                'name' => $this->request['name'],
                'author' => $this->request['author'],
                'publish_year' => $this->request['publish_year'],
                'user_id' => $this->request['user_id'],
                ];
            $book = Book::create($fields);
            // Выводим сообщение и id пользователя
            $response = new Success('Book was added',$book->id);
            return $response;
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error($t->getMessage());
            return $response;
        }
    }
}
