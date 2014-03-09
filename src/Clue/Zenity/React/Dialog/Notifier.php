<?php

class Notifier implements DialogInterface
{
    private $listen = true;

    protected function getType()
    {
        return 'notification';
    }

    public function launch()
    {
        return NotifierZen($this->launcher->createProcess($this));
    }

    public function waitFor()
    {
        return new \BadMethodCallException();
    }
}
