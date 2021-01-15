<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ControllerInterface;

/**
 * Class BookAdd
 * @package Work\Controllers
 */
abstract class BaseController
{
    protected $request;

    function __construct(array $request)
    {
        $this->request=$request;
    }
}
