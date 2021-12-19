<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

use PhpCsFixer\Config;

$config = require __DIR__ . '/vendor/drupol/php-conventions/config/php73/php_cs_fixer.config.php';

/** @var Config $config */
$config
    ->getFinder()
    ->in(
        [__DIR__ . '/src', __DIR__ . '/tests', __DIR__ . '/tests/benchmarks', __DIR__ . '/tests/static-analysis']
    );

return $config;
