<?php

use React\EventLoop\Factory;
use Clue\Zenity\React\Launcher;
use Clue\Zenity\React\Dialog\FileSelection;
use Clue\Zenity\React\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$progress = $builder->pulsate('Pseudo-processing...')->launch();

$texts = array(
    'Preparing',
    'Downloading',
    'Unpacking',
    'Patching',
    'Bootstrapping',
    'Building',
    'Cleaning',
    'Finishing'
);

$timer = $loop->addPeriodicTimer(2.0, function ($timer) use ($progress, $texts) {
    static $i = 0;

    if (isset($texts[$i])) {
        $text = $texts[$i++];
        $text = '[' . $i . '/' . count($texts) . '] ' . $text . '...';

        $progress->setText($text);
    } else {
        $progress->complete();
    }
});

$progress->then(function () use ($timer, $builder) {
    $timer->cancel();

    $builder->info('Done')->launch();
});

$progress->then(null, function() use ($timer, $builder) {
    $timer->cancel();

    $builder->error('Canceled')->launch();
});

$loop->run();
