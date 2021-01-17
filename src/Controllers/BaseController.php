<?php
declare(strict_types=1);

namespace Work\Controllers;

/**
 * Базовый класс для всех контроллеров. Содержит конструктор, которому передаётся объект $_REQUEST
 * @package Work\Controllers
 */
abstract class BaseController
{
    /**
     * @var request переменные запросы
     */
    protected $request;

    /**
     * Получает переменные запроса и сохраняет в локальный объект
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }
}
