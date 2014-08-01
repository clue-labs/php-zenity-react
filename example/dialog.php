<?php

use React\EventLoop\Factory;
use Clue\React\Zenity\Launcher;
use Clue\React\Zenity\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$builder->entry('What\'s your name?', getenv('USER'))->setTitle('Enter your name')->launch()->then(function ($name) use ($builder) {
    $builder->info('Welcome to the introduction of zenity, ' . $name)->launch()->then(function () use ($builder) {
        $builder->question('Do you want to quit?')->launch()->then(function () use ($builder) {
            $builder->error('Oh noes!')->launch();
        }, function() use ($builder) {
            $builder->warning('You should have selected yes!')->launch();
        });
    });
}, function () use ($builder) {
    $builder->warning('No name given')->launch();
});

$loop->run();
