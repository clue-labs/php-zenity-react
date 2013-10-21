<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Zenity;

class ZenityDialog implements DialogInterface
{
    private $zenity;
    private $value = null;

    public function __construct(Zenity $zenity)
    {
        $this->zenity = $zenity;
    }

    public function run()
    {
        return $this->zenity->then();
    }
}
