<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// Whitelist includes 185.26.156.32 which belongs to avior, so that
// app_dev.php can be reached using a tunnel as decribed here:
// Temporarily add a line to your local /etc/hosts file ...
// 127.0.0.1 		plans-for-retrospectives.com
// ... so your browser will make a request to 127.0.0.1 using the correct domain name. Then:
// Make sure you have a free local port 443 (i.e. no local webserver running on it).
// Test it by tryning to access https://plans-for-retrospectives.com, there should be a connection error.
// Then create the tunnel.
// sudo ssh -N -L 443:plans-for-retrospectives.com:443 retromat@avior.uberspace.de
// Now you should be able to access https://plans-for-retrospectives.com/app_dev.php
if (!(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', '185.26.156.32']) || PHP_SAPI === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
