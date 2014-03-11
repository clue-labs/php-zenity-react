<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Zen\NotifierZen;
use BadMethodCallException;

class Notifier extends Notification
{
    private $listen = true;

    protected function getType()
    {
        return 'notification';
    }

    protected function createZen($deferred, $process)
    {
        return new NotifierZen($deferred, $process);
    }

    public function waitFor()
    {
        return new BadMethodCallException();
    }
}
