<?php
declare(strict_types=1);

namespace Work\Response;

use Work\Interfaces\ResponseInterface;

/**
 * {@inheritDoc}
 * Создаём JSON с описанием ошибки
 * @package Work\Controllers
 */
class Error implements ResponseInterface
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var int
     * Код ответа
     */
    private int $code;

    /**
     * Error constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return string
     * Возвращает тело ответа
     */
    public function getResult(): string
    {
        return json_encode(['result' => 'error', 'message' => $this->message], JSON_UNESCAPED_UNICODE);
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
