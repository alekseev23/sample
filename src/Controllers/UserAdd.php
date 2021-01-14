<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Models\User;


class UserAdd implements ResponseInterface
{

    private $res;

    public function process():int
    {
        if (isset($_REQUEST['name']))
        {
            // Пробуем добавить нового пользователя
            try {
                $name = $_REQUEST['name'];
                $fields = ['name' => $name];
                $user = \Work\Models\User::create($fields);
                // Выводим сообщение и id пользователя
                $this->res['result'] = 'success';
                $this->res['message'] = 'User was added';
                $this->res['id'] = $user->id;
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