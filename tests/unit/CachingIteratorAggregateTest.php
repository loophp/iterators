<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\CachingIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class CachingIteratorAggregateTest extends TestCase
{
    public function testWithAGenerator(): void
    {
        $input = static function () {
            yield from range('a', 'c');
        };

        $iterator = (new CachingIteratorAggregate($input()));

        foreach ($iterator as $key => $value);

        foreach ($iterator as $key => $value);

        $this->expectNotToPerformAssertions();
    }
}
