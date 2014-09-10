<?php

require_once('vendor/autoload.php');

function miner_autoload($className)
{
	require_once(dirname(__FILE__) . "/src/$className.php");
}

spl_autoload_register('miner_autoload');
