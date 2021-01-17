<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Interfaces\ControllerInterface;
use Work\Interfaces\ResponseInterface;
use Work\Response\Error;

/**
 * Заглушка для ситуации, когда контроллер для заданного пути не найден
 * @package Work\Controllers
 */
class NotFound extends BaseController implements ControllerInterface
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        return new Error('Not found');
    }
}
