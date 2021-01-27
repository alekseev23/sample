<?php
declare(strict_types=1);

namespace Work\Listeners;

class DemoListener
{
    public function onDemoEvent(Event $event)
    {
        // fetch event information here
        echo "DemoListener is called!\n";
        echo "The value of the foo is: " . $event->getFoo() . "\n";
    }
}
