<?php

require_once 'Deployment/DeploymentU7.php';

$deployment = new DeploymentU7($argv[1]);
$deployment->run();
