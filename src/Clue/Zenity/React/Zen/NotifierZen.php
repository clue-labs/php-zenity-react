<?php

namespace Clue\Zenity\React\Zen;

class NotifierZen extends BaseZen
{
    public function setIcon($icon)
    {
        $this->writeln('icon:' . $icon);

        return $this;
    }

    public function setVisible($visible)
    {
        $this->writeln('visible:' . ($visible ? 'true' : 'false'));

        return $this;
    }

    public function setMessage($message)
    {
        $this->writeln('message:' . $message);

        return $this;
    }

    public function setTooltip($tooltip)
    {
        $this->writeln('tooltip:' . $tooltip);

        return $this;
    }

    public function sendNotification($message, $icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }
        $this->setMessage($message);
    }
}
