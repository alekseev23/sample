<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Models\User;


class UserList implements ResponseInterface
{

    private $errorNumber, $users, $res;

    public function process():int
    {
        try {
            if (isset($_REQUEST['name']))
            {
                // Use name for pattern
                $this->users = \Work\Models\User::where('name', 'like', $_REQUEST['name'])->get();
            }
            else {
                // Показать всех пользователей
                $this->users = \Work\Models\User::all();
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
            return json_encode($this->users);
        }
        else {
            return json_encode($this->res);
        }
    }

}
