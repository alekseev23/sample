<?php
declare(strict_types=1);

namespace Work\Interfaces;

/**
 * @ Этот интерфейсный класс служит для добавления функциональности объекту обрабатывающему ответ клиенту
 */
interface ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface;
}
