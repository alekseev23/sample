<?php

declare(strict_types=1);

namespace Work\Response;

use \Work\Interfaces\ResponseInterface;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
class Data implements ResponseInterface
{
    private $Data;

    public function setMessage(array $data): void {
        $this->Data=$data;
    }

    public function getResult(): string {
        return json_encode($this->Data);
    }
}
