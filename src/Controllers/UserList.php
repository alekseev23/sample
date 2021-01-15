<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Models\User;
use \Work\Response\Data;
use \Work\Response\Error;

class UserList extends BaseController implements ControllerInterface
{
    public function process(): ResponseInterface
    {
        try {
            if (isset($this->request['name'])) {
                // Use name for pattern
                $users = User::where('name', 'like', $this->request['name'])->get();
            } else {
                // Показать всех пользователей
                $users = User::all();
            }
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error();
            $response->setMessage($t->getMessage());
            return $response;
        }
        $response = new Data($users);
        return $response;
    }
}
