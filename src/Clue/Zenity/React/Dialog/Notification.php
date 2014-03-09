<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Dialog\AbstractDialog;

class Notification extends AbstractDialog
{
    protected $text;

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
