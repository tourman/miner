<?php

require_once(dirname(__FILE__) . implode(DIRECTORY_SEPARATOR, explode('/', '/src/MinerController.php')));

$controller = new MinerController();
$controller->process();
