<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Models\Book;
use \Work\Response\Data;
use \Work\Response\Error;

class BookList extends BaseController implements ControllerInterface
{
    public function process(): ResponseInterface
    {
        try {
            if (isset($this->request['name']))  {
                // Use name for pattern
                $books = Book::where('name', 'like', $this->request['name'])->get();
            } else {
                // Показать все книжки
                $books  = Book::all();
            }
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error($t->getMessage());
            return $response;
        }
        $response = new Data($books);
        return $response;
    }
}
