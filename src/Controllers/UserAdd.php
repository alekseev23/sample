<?php

declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Models\User;


class UserAdd implements ControllerInterface
{
    private $res,$Request;

    public function setRequestParameters(array $request): void
    {
        $this->Request=$request;
    }

    public function process(): ResponseInterface
    {
        // Не задано имя пользователя
        if (!isset($this->Request['name'])) {
            $response=new \Work\Response\Error();
            $response->setMessage('Variable [name] not found');
            return($response);
        }
        // Пробуем добавить нового пользователя
        try {
            $name = $this->Request['name'];
            $fields = ['name' => $name];
            $user = \Work\Models\User::create($fields);
            // Выводим сообщение и id пользователя
            $response=new \Work\Response\Success();
            $response->setMessage('User was added',$user->id);
            return($response);
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
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
