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
    private object $data;

    /**
     * @var int
     * Код ответа
     */
    private int $code;

    /**
     * Data constructor.
     * @param object $data
     * @param int $code
     */
    public function __construct(object $data,int $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Возвращает код ответа
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}
