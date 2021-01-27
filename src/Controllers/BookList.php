<?php
declare(strict_types=1);

namespace Work\Controllers;

use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Models\Book;
use Work\Response\Data;
use Work\Response\Error;

/**
 * Получаем список книг
 * @package Work\Controllers
 */
class BookList extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        try {
            if (isset($this->request['name'])) {
                // Используем name как паттерн
                $books = Book::where('name', 'like', $this->request['name'])->get();
            } else {
                // Показать все книжки
                $books = Book::all();
            }
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage(), 500);
        }
        return new Data($books);
    }
}
