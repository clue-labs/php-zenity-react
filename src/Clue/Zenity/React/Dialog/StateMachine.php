<?php

namespace Clue\Zenity\React\Dialog;

use Clue\Zenity\React\Builder;
use React\Promise\PromiseInterface;

class StateMachine
{
    private $dialog = null;
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function addDialog($name, Zenity $zenity)
    {
        if ($this->dialog === null) {
            $this->dialog = $zenity;
        }

    }

    public function addStatePulsate($name, $callback)
    {
        $pulsate = $this->builder->pulsate();

        $this->addDialog($name, new CallbackDialog(function() use ($pulsate) {
            $pulsate->run();

            $ret = When::lazy($callback);

            // stop pulsating on success or error
            $ret->then(array($pulsate, 'close'), array($pulsate, 'close'));

            return $ret;
        }));

        return $pulsate;
    }

    public function addStateProgress($name, PromiseInterface $promise)
    {
        $progress = $this->builder->progress();

        $this->addDialog($name, new CallbackDialog(function() use ($progress) {
            $progress->run();



        }));

        return $progress;
    }

    public function addStateMenu($name, array $menu)
    {
        $menu = $this->builder->listMenu($menu);

        foreach ($menu as $selection => $unusedTitle) {
            $this->addTransition($name, $selection, $selection);
        }

        return $menu;
    }

    public function addStateDialog($name, Zenity $zenity)
    {
        $this->addDialog($name, $zenity);
        //$this->addTransition($name, , $with)
    }

    public function addTransitions(array $transitions)
    {

    }

    public function addTransition($from, $to, $with)
    {

    }

    public function addTransitionDefault($from, $to)
    {
        return $this->addTransition($from, $to, null);
    }

    public function addTransitionCancel($from, $to)
    {
        return $this->addTransition($from, $to, false);
    }

    public function getValue($dialogname)
    {
        return $this->getDialog($dialogname)->getValue();
    }

    public function getDialog($dialog)
    {

    }

    public function getDialogStart()
    {

    }

    public function setDialogStart(DialogInterface $dialog)
    {

    }

    public function run()
    {

    }
}
