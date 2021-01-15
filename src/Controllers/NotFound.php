<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Response\Error;

class NotFound extends BaseController implements ControllerInterface
{
    public function process(): ResponseInterface
    {
       $response = new Error('Not found');
       return $response;
    }
}
