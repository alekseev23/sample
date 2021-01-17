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
    private $id;

    /**
     * Success constructor.
     * @param string $message
     * @param int $id
     */
    public function __construct(string $message, int $id)
    {
        $this->message = $message;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return json_encode(['result' => 'success', 'message' => $this->message, 'id' => $this->id]);
    }
}
