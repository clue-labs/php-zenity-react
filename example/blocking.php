<?php

use React\EventLoop\Factory;
use Clue\Zenity\React\Launcher;
use Clue\Zenity\React\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$name = $builder->entry('Search package')->waitFor();
if ($name === false) {
    exit;
}

$pulser = $builder->pulsate('Searching packagist.org for "' . $name . '"...')->launch();
sleep(3);
$pulser->close();

$packages = array('mink', 'behat', 'phpunit', 'box', 'boris');
$pid = $builder->listRadio($packages, 'Select package')->waitFor();

var_dump($packages[$pid]);
