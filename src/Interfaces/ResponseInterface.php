<?php
declare(strict_types=1);

namespace Work\Interfaces;

/**
 * Этот интерфейсный класс служит для добавления функциональности объекту обрабатывающему ответ клиенту
 * @package Work\Interfaces
 */
interface ResponseInterface
{
    /**
     * @return string Json строка с результатами
     */
    public function getResult(): string;
}
