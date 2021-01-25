<?php
declare(strict_types=1);

//namespace EventDispatchers\Listeners;
namespace Work\Listeners;

use Symfony\Component\EventDispatcher\EventDispatcher;
//use Symfony\EventDispatcher\Event;

class DemoListener
{
    public function onDemoEvent(Event $event)
    {
        // fetch event information here
        echo "DemoListener is called!\n";
        echo "The value of the foo is: ".$event->getFoo()."\n";
    }
}