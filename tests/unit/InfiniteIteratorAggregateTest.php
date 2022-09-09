<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use LimitIterator;
use loophp\iterators\InfiniteIteratorAggregate;
use loophp\iterators\NormalizeIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class InfiniteIteratorAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $input = static function () {
            yield from range('a', 'c');
        };

        $iterator = new NormalizeIterableAggregate(
            new LimitIterator(
                (new InfiniteIteratorAggregate($input()))->getIterator(),
                0,
                5
            )
        );

        $expected = ['a', 'b', 'c', 'a', 'b'];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
