<?php
declare(strict_types=1);

namespace Work\Controllers;

use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Response\Data;
use Work\Response\Error;

/**
 * {@inheritDoc}
 * Получаем значение по ключу из базы Redis
 * @package Work\Controllers
 */
class GetKeyToRedis extends BaseController
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
        try {
            $res = $this->redis->get($this->request['key']);
            if ($res !== '') return new Data(['value' => $res], 200);
            else new Error('This key absent in Redis', 404);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage(), 500);
        }
    }
}
