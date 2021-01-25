<?php
declare(strict_types=1);

//namespace EventDispatchers\Events;
namespace Work\Events;

use Symfony\Component\EventDispatcher\Event;
//use Symfony\EventDispatcher\Event;

class DemoEvent extends Event
{
    const NAME = 'demo.event';

    protected $foo;

    public function __construct()
    {
        $this->foo = 'bar';
    }

    public function getFoo()
    {
        return $this->foo;
    }
}