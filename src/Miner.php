<?php

require_once(dirname(__FILE__) . implode(DIRECTORY_SEPARATOR, explode('/', '/MinerLocationFiniteStateMachine.php')));

class Miner extends FiniteStateMachine
{
    protected $_filling = 0;
    protected $_fatigue = 0;
    protected $_thirst = 0;
    protected $_symbol = '*';

    protected $_fsmLocation;

    public function __construct(array $initData = array())
    {
        $this->_fsmLocation = new MinerLocationFiniteStateMachine();
        if ($initData) {
            $this->_filling = $initData['filling'];
            $this->_fatigue = $initData['fatigue'];
            $this->_thirst = $initData['thirst'];
            $this->_symbol = $initData['symbol'];
            $this->_fsmLocation->setStateSet($initData['log']);
        } else {
            $this->_fsmLocation->setStateSet();
        }
    }

    public function getData()
    {
        return array(
            'filling' => $this->_filling,
            'fatigue' => $this->_fatigue,
            'thirst' => $this->_thirst,
            'symbol' => $this->_symbol,
            'log' => $this->_fsmLocation->sleep(),
        );
    }

    public function update()
    {
        $symbol = $this->_symbol;
        $this->_symbol = '*';
        $this->_fsmLocation->action($symbol, array($this));
        $this->_fsmLocation->displayLog();
    }

    public function fill()
    {
        $this->_filling++;
        if ($this->_filling >= 5) {
            $this->_symbol = 'full';
        }
    }

    public function withdraw()
    {
        $this->_filling = 0;
        $this->_symbol = 'empty';
    }

    public function thirst()
    {
        $this->_thirst++;
        if ($this->_thirst >= 3) {
            $this->_symbol = 'thirst';
        }
    }

    public function drink()
    {
        $this->_thirst--;
        if ($this->_thirst <= 0) {
            $this->_symbol = 'quenched';
        }
    }

    public function fatigue()
    {
        $this->_fatigue++;
        if ($this->_fatigue >= 2) {
            $this->_symbol = 'tired';
        }
    }

    public function rest()
    {
        $this->_fatigue--;
        if ($this->_fatigue <= 0) {
            $this->_symbol = 'rested';
        }
    }
}
