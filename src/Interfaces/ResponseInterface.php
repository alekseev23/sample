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
     * Возвращает Json строку с результатами
     * @return string
     */
    public function getResult(): string;

    /**
     * Возвращает код ответа
     * @return int
     */
    public function getCode(): int;
}
