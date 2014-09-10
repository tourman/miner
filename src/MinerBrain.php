<?php

class MinerBrain extends FiniteStateMachine
{
    public function fill($filling)
    {
        $symbol = '*';
        if ($filling >= 3) {
            $symbol = 'full';
        }
        return $symbol;
    }

    public function withdraw($filling)
    {
        $symbol = '*';
        if ($filling == 0) {
            $symbol = 'empty';
        }
        return $symbol;
    }

    public function thirst($thirst)
    {
        $symbol = '*';
        if ($thirst >= 2) {
            $symbol = 'thirst';
        }
        return $symbol;
    }

    public function drink($thirst)
    {
        $symbol = '*';
        if ($thirst == 0) {
            $symbol = 'quenched';
        }
        return $symbol;
    }

    public function fatigue($fatigue)
    {
        $symbol = '*';
        if ($fatigue >= 1) {
            $symbol = 'tired';
        }
        return $symbol;
    }

    public function rest($fatigue)
    {
        $symbol = '*';
        if ($fatigue == 0) {
            $symbol = 'rested';
        }
        return $symbol;
    }
}
