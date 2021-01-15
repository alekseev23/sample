<?php
/**
 * @ Этот интерфейсный класс служит для добавления функциональности объекту обрабатывающему ответ клиенту
 * @author Alexander Alekseev
 * @copyright 2021 Noname
 */
declare(strict_types=1);

namespace Work\Interfaces;

interface ResponseInterface
{
    /**
     * @return string Json строка с результатами
     */
    public function getResult(): string;
}
