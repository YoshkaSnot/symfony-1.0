<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

/**
 * @param array<string, mixed> $context
 */
return function (array $context) {
    $kernel = new Kernel('dev', true);

    if(isset($context['APP_ENV']) && isset($context['APP_DEBUG'])) {
        $kernel = new Kernel((string) $context['APP_ENV'], (bool) $context['APP_DEBUG']);
    }
    return $kernel;
};
