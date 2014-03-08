<?php

use React\EventLoop\Factory;
use Clue\Zenity\React\Launcher;
use Clue\Zenity\React\Dialog\FileSelection;
use Clue\Zenity\React\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$notification = $builder->notifier();
$notification->setMessage('Hello world');

$n = 0;
$loop->addPeriodicTimer(10.0, function ($timer) use ($notification, &$n) {
    $notification->setMessage('Hi' . ++$n);
});


$loop->run();
