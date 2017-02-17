<?php

require_once 'Deployment/Deployment.php';

$deployment = new Deployment($argv[1]);
$deployment->run();
