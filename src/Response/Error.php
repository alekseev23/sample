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
    private $message;

    /**
     * @var Код ответа
     */
    private $code;

    /**
     * Error constructor.
     * @param string $message
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
     * @return string
     * Возвращает HTTP заголовок для отправки клиенту
     */
    public function getHeader(): string
    {
        if ($this->code == 404) {
            return $_SERVER["SERVER_PROTOCOL"] . " 404 Not found";
        }
        if ($this->code == 405) {
            return $_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed";
        }
        return $_SERVER["SERVER_PROTOCOL"] . " 500 Internal server error";
    }
}
