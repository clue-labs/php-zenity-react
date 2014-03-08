<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Zenity;

class Warning extends Zenity
{
    protected $text;

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
