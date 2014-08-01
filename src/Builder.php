<?php

namespace Clue\React\Zenity;

use Clue\React\Zenity\Launcher;
use Clue\React\Zenity\Dialog\Question;
use Clue\React\Zenity\Dialog\Info;
use Clue\React\Zenity\Dialog\Warning;
use Clue\React\Zenity\Dialog\Error;
use Clue\React\Zenity\Dialog\Entry;
use Clue\React\Zenity\Dialog\FileSelection;
use Clue\React\Zenity\Dialog\Progress;
use Clue\React\Zenity\Dialog\Notification;
use Clue\React\Zenity\Dialog\TextInfo;
use Clue\React\Zenity\Dialog\Listing;
use Clue\React\Zenity\Dialog\Notifier;

/**
 * Convenience class used to construct common zenity dialogs
 */
class Builder
{
    private $launcher;

    public function __construct(Launcher $launcher)
    {
        $this->launcher = $launcher;
    }

    public function info($text, $title = null)
    {
        $zenity = new Info($this->launcher);
        $zenity->setText($text);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function warning($text, $title = null)
    {
        $zenity = new Warning($this->launcher);
        $zenity->setText($text);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function error($text, $title = null)
    {
        $zenity = new Error($this->launcher);
        $zenity->setText($text);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function question($question, $title = null)
    {
        $zenity = new Question($this->launcher);
        $zenity->setText($question);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function entry($prompt = null, $prefill = null)
    {
        $zenity = new Entry($this->launcher);
        $zenity->setText($prompt);
        $zenity->setEntryText($prefill);

        return $zenity;
    }

    public function fileSelection($title = null, $multiple = false)
    {
        $zenity = new FileSelection($this->launcher);
        $zenity->setTitle('Select any file');
        $zenity->setMultiple($multiple);

        return $zenity;
    }

    public function fileSave($title, $previous = null)
    {
        $zenity = new FileSelection($this->launcher);
        $zenity->setTitle($title);
        $zenity->setFilename($previous);
        $zenity->setSave(true);
        $zenity->setConfirmOverwrite(true);

        return $zenity;
    }

    public function directorySelection($title = null, $multiple = false)
    {
        $zenity = new FileSelection($this->launcher);
        $zenity->setDirectory(true);
        $zenity->setTitle($title);
        $zenity->setMultiple($multiple);

        return $zenity;
    }

    public function progress($text = null)
    {
        $zenity = new Progress($this->launcher);
        $zenity->setText($text);
        $zenity->setAutoClose(true);

        return $zenity;
    }

    public function pulsate($text = null)
    {
        $zenity = new Progress($this->launcher);
        $zenity->setText($text);
        $zenity->setPulsate(true);
        $zenity->setAutoClose(true);

        return $zenity;
    }

    public function notification($text, $icon = null)
    {
        $zenity = new Notification($this->launcher);
        $zenity->setText($text);
        $zenity->setIcon($icon);

        return $zenity;
    }

    public function notifier()
    {
        $zenity = new Notifier($this->launcher);

        return $zenity;
    }

    public function text($filename, $title = null)
    {
        $zenity = new TextInfo();
        $zenity->setFilename($filename);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function editable($filename, $title = null)
    {
        $zenity = new TextInfo($this->launcher);
        $zenity->setFilename($filename);
        $zenity->setTitle($title);
        $zenity->setEditable(true);

        return $zenity;
    }

    public function confirmLicense($filename, $confirmation, $title = null)
    {
        $zenity = new TextInfo($this->launcher);
        $zenity->setFilename($filename);
        $zenity->setCheckbox($confirmation);
        $zenity->setTitle($title);

        return $zenity;
    }

    public function listMenu($list, $text = null)
    {
        $zenity = new Listing($this->launcher);
        $zenity->addColumn('Id', true);
        $zenity->addColumn('Value');
        $zenity->setHideHeader(true);
        $zenity->setText($text);

        // $zenity->run();

        foreach ($list as $key => $value) {
            $zenity->writeLine($key);
            $zenity->writeLine($value);
        }

        return $zenity;
    }

    public function listRadio($list, $text = null, $selected = null)
    {
        $zenity = new Listing($this->launcher);
        $zenity->addColumn(' ');
        $zenity->addColumn('Id', true);
        $zenity->addColumn('Value');
        $zenity->setHideHeader(true);
        $zenity->setRadiolist(true);
        $zenity->setPrintColumn(2);
        $zenity->setText($text);

        // $zenity->run();

        foreach ($list as $key => $value) {
            $zenity->writeLine(($selected == $key) ? 'true' : 'false');
            $zenity->writeLine($key);
            $zenity->writeLine($value);
        }

        return $zenity;
    }

    public function listCheck($list, $text = null, $selected = null)
    {
        $zenity = new Listing($this->launcher);
        $zenity->addColumn(' ');
        $zenity->addColumn('Id', true);
        $zenity->addColumn('Value');
        $zenity->setHideHeader(true);
        $zenity->setChecklist(true);
        $zenity->setPrintColumn(2);
        $zenity->setText($text);

        // $zenity->run();

        foreach ($list as $key => $value) {
            $zenity->writeLine(in_array($key, $selected) ? 'true' : 'false');
            $zenity->writeLine($key);
            $zenity->writeLine($value);
        }

        return $zenity;
    }

    public function table($rows, array $columns = null, $text = null)
    {
        if ($columns === null) {
            $columns = array();

            foreach ($rows as $row) {
                $columns = array_keys($row);
                break;
            }
        }
        $width = count($columns);

        $zenity = new Listing($this->launcher);
        $zenity->addColumn('Id', true);
        foreach ($columns as $column) {
            $zenity->addColumn($column);
        }
        $zenity->setText($text);

        // $zenity->run();

        foreach ($rows as $id => $row) {
            $zenity->writeLine($id);

            $n = 0;
            foreach ($row as $column) {
                if (++$n > $width) {
                    break;
                }
                $zenity->writeLine($column);
            }
        }

        return $zenity;
    }
}
