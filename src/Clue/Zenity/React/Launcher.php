<?php

namespace Clue\Zenity\React;

use React\EventLoop\LoopInterface;
use Icecave\Mephisto\Factory\ProcessFactory;
use Icecave\Mephisto\Launcher\CommandLineLauncher;
use Icecave\Mephisto\Process\ProcessInterface;
use Clue\Zenity\React\Dialog\DialogInterface;
use Clue\Zenity\React\Dialog\AbstractDialog;

/**
 *
 * @link https://github.com/clue/zenity-react
 * @link https://help.gnome.org/users/zenity/stable/index.html.en
 */
class Launcher
{
    private $loop;
    private $processLauncher;
    private $bin = 'zenity';

    public function __construct(LoopInterface $loop, CommandLineLauncher $processLauncher = null)
    {
        if ($processLauncher === null) {
            $processFactory = new ProcessFactory($loop);
            $processLauncher = new CommandLineLauncher($processFactory);
        }

        $this->processLauncher = $processLauncher;
        $this->loop = $loop;
    }

    public function setBin($bin)
    {
        $this->bin = $bin;

        return $this;
    }

    public function createProcess(AbstractDialog $dialog)
    {
        return $this->run($dialog->getArgs());
    }

    private function run(array $args = array())
    {
        $command = $this->bin;

        foreach ($args as $name => $value) {
            if (is_int($name)) {
                $command .= ' ' . escapeshellarg($value);
            } else {
                $command .= ' --' . $name . '=' . escapeshellarg($value);
            }
        }

        // var_dump($command);

        $process = $this->processLauncher->runCommandLine($command);
        /* @var $process ProcessInterface */
        return $process;
    }
}
