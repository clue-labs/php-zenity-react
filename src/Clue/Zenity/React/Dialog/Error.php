<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Zenity;

class Error extends Zenity
{
    protected $text;

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
