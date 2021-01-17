<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Interfaces\ControllerInterface;
use Work\Interfaces\ResponseInterface;
use Work\Models\User;
use Work\Response\Error;
use Work\Response\Success;

/**
 * Долбавление нового пользователя
 * @package Work\Controllers
 */
class UserAdd extends BaseController implements ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        // Не задано имя пользователя
        if (!isset($this->request['name'])) {
            return new Error('Variable [name] not found');
        }
        // Пробуем добавить нового пользователя
        try {
            $name = $this->request['name'];
            $fields = ['name' => $name];
            $user = User::create($fields);
            // Выводим сообщение и id пользователя
            return new Success('User was added', $user->id);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage());
        }
    }
}
