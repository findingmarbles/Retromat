<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'declare_strict_types' => false,
        'native_function_invocation' => ['include' => ['@all']],
        'php_unit_mock_short_will_return' => true,
    ])
    ->setFinder($finder);
