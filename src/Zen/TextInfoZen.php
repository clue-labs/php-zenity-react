<?php

namespace Clue\React\Zenity\Zen;

use Clue\React\Zenity\BaseZen;

class TextInfoZen extends BaseZen
{
    public function addLine($line)
    {
        $this->writeln($line);

        return $this;
    }
}
