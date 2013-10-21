<?php

use React\EventLoop\Factory;
use Clue\Zenity\React\Launcher;
use Clue\Zenity\React\Builder;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();

$launcher = new Launcher($loop);
$builder = new Builder($launcher);

$dialog = new Dialog($loop);
$dialog->addDialog($builder->entry('What\'s your name?', getenv('USER'))->setTitle('Enter your name'), 'whatsyourname')
    ->addTransition('noname', false)
    ->addTransition('welcomenname');
$dialog->addDialog($builder->info('Welcome to the introduction of zenity, ' . $name), 'welcomename')
    ->addTransition('doyouwanttoquit');
$dialog->addDialog($builder->question('Do you want to quit?'), 'doyouwanttoquit')
    ->addTransition('yesquit', true)
    ->addTransition('noquit', false);
$dialog->addDialog($builder->error('Oh noes!'), 'yesquit');
$dialog->addDialog($builder->warning('You should have selected yes!'), 'noquit');
//  ->addTransition('welcomename');
$dialog->addDialog($builder->warning('No name given'), 'noname');
//  ->addTransition('whatsyourname');

$dialog->run();


$login = new StateMachine();

$login->addDialog('ask', new ZenityDialog($builder->entry('Password')->setHideText(true)));
$login->addTransitionCancel('ask', null);
$login->addTransition('ask', 'success', 'secret');
$login->addTransitionDefault('ask', 'error');

$login->addDialog('success', new ZenityDialog($builder->info('Successfully logged in!')));

$login->addDialog('error', new ZenityDialog($builder->warning('Invalilid login, please try again')));
$login->addTransition('error', 'ask', true);

$login->run();


$menu = new StateMachine();
$menu->addDialog('main', new ZenityDialog($builder->listMenu(array('about' => 'About', 'config' => 'Configuration'), 'menu')));
$menu->addTransitionCancel('main', null);
$menu->addTransition('main', 'about', 'about');
$menu->addTransition('main', 'config', 'config');
$menu->addTransitionDefault('main', 'main');

$menu->addDialog('about', new ZenityDialog($builder->info('about')));
$menu->addTransitionDefault('about', 'main');

$menu->addDialog('config', new ZenityDialog($builder->confirmLicense('/var/log/syslog', 'Confirm config')));
$menu->addTransitionDefault('config', 'saving');

$menu->addStatePulsate('saving', function() {
    sleep(5);

    return true;
});

