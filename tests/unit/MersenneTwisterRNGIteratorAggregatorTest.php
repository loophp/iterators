<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use LimitIterator;
use loophp\iterators\MersenneTwisterRNGIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class MersenneTwisterRNGIteratorAggregatorTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator =
            new LimitIterator(
                (new MersenneTwisterRNGIteratorAggregate())->withMin(1)->withMax(100)->getIterator(),
                0,
                100
            );

        $expected = range(0, 100);
        self::assertNotSame($expected, iterator_to_array($iterator));
    }

    public function testWithSeed(): void
    {
        $seed = 123;

        $iterator =
            new LimitIterator(
                (new MersenneTwisterRNGIteratorAggregate())->withMin(1)->withMax(10)->withSeed($seed)->getIterator(),
                0,
                10
            );

        $expected = [3, 10, 3, 1, 1, 3, 7, 8, 10, 5];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
