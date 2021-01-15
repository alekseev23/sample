<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Models\User;
use \Work\Response\Error;
use \Work\Response\Success;

class UserAdd extends BaseController implements ControllerInterface
{
    public function process(): ResponseInterface
    {
        // Не задано имя пользователя
        if (!isset($this->request['name'])) {
            $response = new Error('Variable [name] not found');
            return $response;
        }
        // Пробуем добавить нового пользователя
        try {
            $name = $this->request['name'];
            $fields = ['name' => $name];
            $user = User::create($fields);
            // Выводим сообщение и id пользователя
            $response = new Success('User was added',$user->id);
            return $response;
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error($t->getMessage());
            return $response;
        }
    }
}
