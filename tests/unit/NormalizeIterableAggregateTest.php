<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\NormalizeIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class NormalizeIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $input = static function () {
            yield from array_combine(range('a', 'c'), range('a', 'c'));
        };

        $iterator = new NormalizeIterableAggregate($input());

        $expected = ['a', 'b', 'c'];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
