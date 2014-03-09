<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Dialog\AbstractDialog;

class TextInfo extends AbstractDialog
{
    protected $filename;

    protected $editable = false;

    protected $checkbox;

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function setEditable($editable)
    {
        $this->editable = !!$editable;

        return $this;
    }

    public function setCheckbox($checkbox)
    {
        $this->checkbox = $checkbox;

        return $this;
    }

    public function setText($text)
    {
        $this->inbuffer = $text;

        return $this;
    }

    public function addLine($line)
    {
        $this->inbuffer .= $line . PHP_EOL;

        return $this;
    }
}
