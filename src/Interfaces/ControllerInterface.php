<?php
declare(strict_types=1);

namespace Work\Interfaces;

interface ControllerInterface
{
    public function process(): ResponseInterface;

}