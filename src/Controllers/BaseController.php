<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Interfaces\ControllerInterface;

/**
 * Базовый класс для всех контроллеров. Содержит конструктор, которому передаётся объект $_REQUEST
 * @package Work\Controllers
 */
abstract class BaseController implements ControllerInterface
{
    /**
     * @var array $request переменные запроса
     */
    protected array $request;

    /**
     * Получает переменные запроса и сохраняет в локальный объект
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }
}
