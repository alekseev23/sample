<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Interfaces\ControllerInterface;
use Work\Interfaces\ResponseInterface;
use Work\Models\User;
use Work\Response\Data;
use Work\Response\Error;

/**
 * Показать список пользователей
 * @package Work\Controllers
 */
class UserList extends BaseController implements ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        try {
            if (isset($this->request['name'])) {
                // Используем name как паттерн
                $users = User::where('name', 'like', $this->request['name'])->get();
            } else {
                // Показать всех пользователей
                $users = User::all();
            }
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage());
        }
        return new Data($users);
    }
}
