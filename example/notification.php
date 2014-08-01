<?php

use React\EventLoop\Factory;
use Clue\React\Zenity\Launcher;
use Clue\React\Zenity\Dialog\FileSelection;
use Clue\React\Zenity\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder();

$notification = $launcher->launch($builder->notifier());
$notification->sendNotification('Hello world');

$n = 0;
$loop->addPeriodicTimer(10.0, function ($timer) use ($notification, &$n) {
    $icons = array(null, 'error', 'info', 'warning');
    shuffle($icons);

    $notification->sendNotification('Hi' . ++$n, reset($icons));
});


$loop->run();
