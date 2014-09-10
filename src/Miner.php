<?php

class Miner extends MinerBrain
{
    protected $_filling = 0;
    protected $_fatigue = 0;
    protected $_thirst = 0;
    protected $_symbol = '*';
    protected $_brain;

    protected $_fsmLocation;

    public function __construct(array $initData = array())
    {
        $this->_brain = new MinerBrain();
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

    protected function _symbol($symbol)
    {
        if ($this->_symbol != '*') {
            return;
        }
        $this->_symbol = $symbol;
    }

    public function fill()
    {
        $this->_filling++;
        $this->_symbol( $this->_brain->fill($this->_filling) );
    }

    public function withdraw()
    {
        $this->_filling = 0;
        $this->_symbol( $this->_brain->withdraw($this->_filling) );
    }

    public function thirst()
    {
        $this->_thirst++;
        $this->_symbol( $this->_brain->thirst($this->_thirst) );
    }

    public function drink()
    {
        $this->_thirst--;
        $this->_symbol( $this->_brain->drink($this->_thirst) );
    }

    public function fatigue()
    {
        $this->_fatigue++;
        $this->_symbol( $this->_brain->fatigue($this->_fatigue) );
    }

    public function rest()
    {
        $this->_fatigue--;
        $this->_symbol( $this->_brain->rest($this->_fatigue) );
    }
}
