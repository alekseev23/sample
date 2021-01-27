<?php
declare(strict_types=1);

namespace Work\Response;

use Work\Interfaces\ResponseInterface;

/**
 * Создаём JSON с данными
 * @package Work\Controllers
 */
class Data implements ResponseInterface
{
    /**
     * @var object
     */
    private $data;

    /**
     * Data constructor.
     * @param object $data
     */
    public function __construct(object $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $_SERVER["SERVER_PROTOCOL"] . " 200 OK";
    }
}
