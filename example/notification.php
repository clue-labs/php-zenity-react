<?php

use React\EventLoop\Factory;
use Clue\Zenity\React\Launcher;
use Clue\Zenity\React\Dialog\FileSelection;
use Clue\Zenity\React\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$notification = $builder->notifier()->launch();
$notification->sendNotification('Hello world');

$n = 0;
$loop->addPeriodicTimer(10.0, function ($timer) use ($notification, &$n) {
    $icons = array(null, 'error', 'info', 'warning');
    shuffle($icons);

    $notification->sendNotification('Hi' . ++$n, reset($icons));
});


$loop->run();
