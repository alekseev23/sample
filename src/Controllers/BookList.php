<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Models\Book;

class BookList implements ResponseInterface
{

    private $errorNumber, $books, $res;

    public function process():int
    {
        try {
            if (isset($_REQUEST['name']))
            {
                // Use name for pattern
                $this->books = \Work\Models\Book::where('name', 'like', $_REQUEST['name'])->get();
            }
            else {
                // Показать все книжки
                $this->books  = \Work\Models\Book::all();
            }
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $this->res['result'] = 'error';
            $this->res['message'] = $t->getMessage();
            $this->errorNumber = -1;
            return $this->errorNumber;
        }
        $this->errorNumber = 0;
        return $this->errorNumber;
    }

    public function getResult():string
    {
        if ($this->errorNumber==0)
        {
            return json_encode($this->books);
        }
        else {
            return json_encode($this->res);
        }
    }

}
