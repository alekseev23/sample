<?php
declare(strict_types=1);

namespace Work\Interfaces;

use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @ Этот интерфейсный класс служит для добавления функциональности объекту обрабатывающему ответ клиенту
 */
interface ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface;

    public function setDispatcher(EventDispatcher $dispatcher);
}
