<?php

declare(strict_types=1);

namespace Work\Response;

use \Work\Interfaces\ResponseInterface;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
class Success implements ResponseInterface
{
    private $message;
    private $id;

    function __construct(string $message,int $id)
    {
        $this->message=$message;
        $this->id=$id;
    }

    public function getResult(): string
    {
        return json_encode(['result' => 'success', 'message' => $this->message, 'id' => $this->id]);
    }
}
