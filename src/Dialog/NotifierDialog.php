<?php

namespace Clue\React\Zenity\Dialog;

use Clue\React\Zenity\Zen\NotifierZen;
use BadMethodCallException;

class NotifierDialog extends NotificationDialog
{
    private $listen = true;

    protected function getType()
    {
        return 'notification';
    }

    public function createZen($deferred, $process)
    {
        return new NotifierZen($deferred, $process);
    }

    public function waitFor()
    {
        return new BadMethodCallException();
    }
}
