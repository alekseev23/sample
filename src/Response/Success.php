<?php

declare(strict_types=1);

namespace Work\Response;

use Work\Interfaces\ResponseInterface;

/**
 * Создаём JSON с кодом успешного выполнения и id добавленной записи
 * @package Work\Controllers
 */
class Success implements ResponseInterface
{
    /**
     * @var string
     */
    private $message;
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     * Код ответа
     */
    private int $code;

    /**
     * Success constructor.
     * @param string $message
     * @param int $id
     * @param int $code
     */
    public function __construct(string $message, int $id,int $code)
    {
        $this->message = $message;
        $this->id = $id;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return json_encode(['result' => 'success', 'message' => $this->message, 'id' => $this->id], JSON_UNESCAPED_UNICODE);
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
