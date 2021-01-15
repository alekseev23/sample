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
    private $Message,$Id;

    public function setMessage(string $message,int $id): void {
        $this->Message=$message;
        $this->Id=$id;
    }

    public function getResult(): string {
        return json_encode(['result' => 'success', 'message' => $this->Message, 'id' => $this->Id]);
    }
}
