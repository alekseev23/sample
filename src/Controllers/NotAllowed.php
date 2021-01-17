<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Interfaces\ControllerInterface;
use Work\Interfaces\ResponseInterface;
use Work\Response\Error;

/**
 * Заглушка для ситуации когда HTTP метод не поддерживается
 * @package Work\Controllers
 */
class NotAllowed extends BaseController implements ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        return new Error('Not allowed');
    }
}
