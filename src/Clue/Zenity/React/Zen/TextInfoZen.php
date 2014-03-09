<?php

namespace Clue\Zenity\React\Zen;

use Clue\Zenity\React\BaseZen;

class TextInfoZen extends BaseZen
{
    public function addLine($line)
    {
        $this->writeln($line);

        return $this;
    }
}
