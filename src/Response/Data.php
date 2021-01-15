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
    private $data;

    function __construct(object $data)
    {
        $this->data=$data;
    }

    public function getResult(): string
    {
        return json_encode($this->data);
    }
}
