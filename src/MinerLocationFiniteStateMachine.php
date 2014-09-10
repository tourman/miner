<?php

class MinerLocationFiniteStateMachine extends FiniteStateMachine
{
    public function setStateSet($log = array())
    {
        $stateSet = array(
            'MINE' => array(
                'full' => array(
                    'state' => 'BANK',
                    'action' => 'bank',
                ),
                'thirst' => array(
                    'state' => 'BAR',
                    'action' => 'quench',
                ),
                '*' => array(
                    'state' => 'MINE',
                    'action' => 'dig',
                ),
            ),
            'BANK' => array(
                'tired' => array(
                    'state' => 'HOME',
                    'action' => 'rest',
                ),
                'empty' => array(
                    'state' => 'MINE',
                    'action' => 'dig',
                ),
            ),
            'HOME' => array(
                'rested' => array(
                    'state' => 'MINE',
                    'action' => 'dig',
                ),
                '*' => array(
                    'state' => 'HOME',
                    'action' => 'rest',
                ),
            ),
            'BAR' => array(
                'quenched' => array(
                    'state' => 'MINE',
                    'action' => 'dig',
                ),
                '*' => array(
                    'state' => 'BAR',
                    'action' => 'quench',
                ),
            ),
        );
        parent::setStateSet($stateSet, $log);
    }

    public function dig(Miner $miner)
    {
        echo("Digging...\n");
        $miner->fill();
        $miner->thirst();
    }

    public function bank(Miner $miner)
    {
        echo("Banking...\n");
        $miner->withdraw();
        $miner->fatigue();
    }

    public function quench(Miner $miner)
    {
        echo("Quenching...\n");
        $miner->drink();
    }

    public function rest(Miner $miner)
    {
        echo("Sleeping...\n");
        $miner->rest();
    }
}
