<?php

namespace Clue\React\Zenity\Zen;

use React\Promise\Deferred;
use Icecave\Mephisto\Process\ProcessInterface;
class ProgressZen extends BaseZen
{
    private $percentage;

    public function __construct(Deferred $deferred, ProcessInterface $process, $percentage)
    {
        parent::__construct($deferred, $process);

        $this->percentage = $percentage;
    }

    public function setText($text)
    {
        $this->writeln('#' . $text);

        return $this;
    }

    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        $this->writeln($percentage);

        return $this;
    }

    public function advance($by)
    {
        $this->setPercentage($this->percentage + $by);

        return $this;
    }

    public function complete()
    {
        $this->setPercentage(100);

        return $this;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }
}
