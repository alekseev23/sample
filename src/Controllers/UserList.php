<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Models\User;

class UserList implements ControllerInterface
{
    private $res,$Request;

    public function setRequestParameters(array $request): void
    {
        $this->Request=$request;
    }

    public function process(): ResponseInterface
    {
        try {
            if (isset($this->Request['name']))
            {
                // Use name for pattern
                $users = \Work\Models\User::where('name', 'like', $this->Request['name'])->get();
            }
            else {
                // Показать всех пользователей
                $users = \Work\Models\User::all();
            }
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response=new \Work\Response\Error();
            $response->setMessage($t->getMessage());
            return($response);
        }
        $response=new \Work\Response\Data();
        $response->setData($users);
        return($response);

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
