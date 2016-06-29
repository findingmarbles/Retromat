<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$allowedClientIPs = [
    '127.0.0.1',
    'fe80::1',
    '::1',
];

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], $allowedClientIPs) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. To gain access, add your IP address '.
        @$_SERVER['REMOTE_ADDR'].' to the $allowedClientIPs list at the top of: '.
        basename(__FILE__).'.'
    );
}

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
