<?php
declare(strict_types=1);

namespace Work\Controllers;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Work\Interfaces\ControllerInterface;

/**
 * Базовый класс для всех контроллеров. Содержит конструктор, которому передаётся объект $_REQUEST
 * @package Work\Controllers
 */
abstract class BaseController implements ControllerInterface
{
    /**
     * @var array<mixed> $request переменные запроса
     */
    protected array $request;
    protected EventDispatcher $dispatcher;
    protected \Redis $redis;

    /**
     * Получает переменные запроса и сохраняет в локальный объект
     * @param array<mixed> $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * @param EventDispatcher $dispatcher
     */
    public function setDispatcher(EventDispatcher $dispatcher)
    {
        $this->$dispatcher = $dispatcher;
    }

    /**
     * @param \Redis $redis
     */
    public function setRedisHandle(\Redis $redis)
    {
        $this->$redis = $redis;
    }
}
