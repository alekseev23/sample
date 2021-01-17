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
     * Error constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return json_encode(['result' => 'error', 'message' => $this->message], JSON_UNESCAPED_UNICODE);
    }
}
