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
    private $message;

    function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getResult(): string
    {
        return json_encode(['result' => 'error', 'message' => $this->message],JSON_UNESCAPED_UNICODE);
    }
}
