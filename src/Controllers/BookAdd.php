<?php
declare(strict_types=1);

namespace Work\Controllers;

use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Models\Book;
use Work\Models\User;
use Work\Response\Error;
use Work\Response\Success;

/**
 * {@inheritDoc}
 * Добавляем книгу с id пользователя в базу данных
 * @package Work\Controllers
 */
class BookAdd extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        // Проверка ID пользователя
        if (!isset($this->request['user_id'])) {
            return new Error('Variable [user_id] not found');
        }
        try {
            if (User::where('id', '=', $this->request['user_id'])->count() == 0) {
                return new Error('Нет пользователя с таким user_id');
            }
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage());
        }

        // Проверка года книги
        $publish_year = intval($this->request['publish_year']);
        if (($publish_year < 1900) || ($publish_year > 2020)) {
            return new Error('Странный год публикации книги');
        }
        // Проверка названия книги
        if (!isset($this->request['name'])) {
            return new Error('Переменная [name] не найдена');
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
            return new Success('Книга добавлена', $book->id);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage());
        }
    }
}
