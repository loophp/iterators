<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\MersenneTwisterRNGIteratorAggregate;
use loophp\iterators\UniqueIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class UniqueIterableAggregatorTest extends TestCase
{
    public function testBasic(): void
    {
        $input = (new MersenneTwisterRNGIteratorAggregate())
            ->withMin(0)
            ->withMax(9)
            ->withSeed(123);

        $iterator = new UniqueIterableAggregate($input, 1000);

        $expected = [2, 9, 3 => 0, 6 => 6, 7 => 7, 9 => 4, 10 => 1, 18 => 3, 22 => 5, 37 => 8];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
