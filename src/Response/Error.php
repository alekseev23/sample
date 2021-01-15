<?php

declare(strict_types=1);

namespace Work\Response;

use \Work\Interfaces\ResponseInterface;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
class Error implements ResponseInterface
{
    private $Message;

    public function setMessage(string $message): void {
        $this->Message=$message;
    }

    public function getResult(): string {
        return json_encode(['result' => 'error', 'message' => $this->Message]);
    }
}
