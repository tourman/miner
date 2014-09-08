<?php

require_once(dirname(__FILE__) . implode(DIRECTORY_SEPARATOR, explode('/', '/Miner.php')));

class MinerController
{
    protected $_fileName = '/tmp/miner.data';

    protected function _getData()
    {
        if (!file_exists($this->_fileName)) {
            return null;
        } else {
            $data = file_get_contents($this->_fileName);
            $data = unserialize($data);
            return $data;
        }
    }

    protected function _setData($data)
    {
        $data = serialize($data);
        $f = fopen($this->_fileName, 'w');
        fwrite($f, $data);
        fclose($f);
    }

    public function process()
    {
        if ($data = $this->_getData()) {
            $miner = new Miner($data);
        } else {
            $miner = new Miner();
        }
        $miner->update();
        $data = $miner->getData();
        $this->_setData($data);
    }
}
