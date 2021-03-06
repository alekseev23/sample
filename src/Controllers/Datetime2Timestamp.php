<?php
declare(strict_types=1);

namespace Work\Controllers;

use DateTime;
use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Response\Data;
use Work\Response\Error;

/**
 * Преобразование DATETIME в TIMESTAMP
 * @package Work\Controllers
 */
class Datetime2Timestamp extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        // Не задано имя переменной
        if (!isset($this->request['datetime'])) {
            return new Error('Переменная [datetime] не найдена', 404);
        }
        // Пробуем преобразовать в DATETIME
        try {
            $dt = DateTime::createFromFormat('Y-m-d h:i:s', $this->request['datetime']);
            return new Data((object)[
                'timestamp' => $dt->getTimestamp()
            ],200);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error($t->getMessage(), 500);
        }
    }
}
