<?php
declare(strict_types=1);

namespace Work\Controllers;

use DateTime;
use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Response\Data;
use Work\Response\Error;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Work\Events\DemoEvent;
use Work\Listeners\DemoListener;
use Symfony\Component\EventDispatcher\Event;

/**
 * Преобразование TIMESTAMP в DATETIME
 * @package Work\Controllers
 */
class Timestamp2Datetime extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        GLOBAL $dispatcher;

        // Не задано имя переменной
        if (!isset($this->request['timestamp'])) {
            // dispatch
            $dispatcher->dispatch(DemoEvent::NAME, new DemoEvent());
            return new Error('Переменная [timestamp] не найдена');
        }
        // Пробуем преобразовать в датувремя
        try {
            $dt = new DateTime();
            $dt->setTimestamp(intval($this->request['timestamp']));
            return new Data((object)[
                'datetime' => $dt->format("Y-m-d h:i:s"),
                'timezone' => $dt->getTimezone()->getName()
            ]);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            // dispatch
            $dispatcher->dispatch(DemoEvent::NAME, new DemoEvent());

            return new Error($t->getMessage());
        }
    }
}
