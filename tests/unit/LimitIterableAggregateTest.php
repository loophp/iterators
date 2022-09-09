<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\LimitIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class LimitIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $input = static function (): Generator {
            yield from range('a', 'c');
        };

        $iterator = new LimitIterableAggregate($input());

        $expected = ['a', 'b', 'c'];
        self::assertSame($expected, iterator_to_array($iterator));

        $iterator = new LimitIterableAggregate($input(), 1);

        $expected = [1 => 'b', 2 => 'c'];
        self::assertSame($expected, iterator_to_array($iterator));

        $iterator = new LimitIterableAggregate($input(), 1, 1);

        $expected = [1 => 'b'];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
