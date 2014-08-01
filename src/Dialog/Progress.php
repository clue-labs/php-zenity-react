<?php

namespace Clue\React\Zenity\Dialog;

use Clue\React\Zenity\Dialog\AbstractDialog;
use Clue\React\Zenity\Zen\ProgressZen;

class Progress extends AbstractDialog
{
    protected $text;
    protected $percentage;
    protected $autoClose = false;

    //protected $autoKill = false;

    protected $pulsate = false;
    protected $noCancel = false;

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function setAutoClose($auto)
    {
        $this->autoClose = !!$auto;

        return $this;
    }

    public function setPulsate($pulsate)
    {
        $this->pulsate = !!$pulsate;

        return $this;
    }

    public function setNoCancel($noc)
    {
        $this->noCancel = !!$noc;

        return $this;
    }

    protected function createZen($deferred, $process)
    {
        return new ProgressZen($deferred, $process, $this->percentage);
    }
}
