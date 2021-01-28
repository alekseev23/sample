<?php
declare(strict_types=1);

namespace Work\Controllers;

use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Response\Error;
use Work\Response\Success;

/**
 * {@inheritDoc}
 * Добавляем ключ со значением в базу Redis
 * @package Work\Controllers
 */
class SetKeyToRedis extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        // Проверка наличия ключа
        if (!isset($this->request['key'])) {
            return new Error('Parameter [key] not found', 404);
        }
        // Проверка наличия значения
        if (!isset($this->request['value'])) {
            return new Error('Parameter [value] not found', 404);
        }
        try {
            $this->redis->lpush($this->request['key'], $this->request['value']);
            return new Success('Значение сохранено', 0, 200);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage(), 500);
        }
    }
}
