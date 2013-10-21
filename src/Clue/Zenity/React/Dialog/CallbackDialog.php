<?php

namespace Clue\Zenity\React\Dialog;

class CallbackDialog implements DialogInterface
{
    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function run()
    {
        $ret = call_user_func($this->callback, $this);

        return $ret;
    }
}
