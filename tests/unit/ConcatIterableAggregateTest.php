<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use loophp\iterators\ConcatIterableAggregate;
use loophp\iterators\NormalizeIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class ConcatIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $generator = static function () {
            yield from range('a', 'c');
        };
        $iterator = new ArrayIterator(range('d', 'f'));
        $array = range('g', 'i');

        $iterator = new NormalizeIterableAggregate(
            new ConcatIterableAggregate([$generator(), $iterator, $array])
        );

        $expected = range('a', 'i');
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
