<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\ReduceIterableAggregate;
use loophp\iterators\ReductionIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class ReduceIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator = (new ReduceIterableAggregate(
            range(0, 10),
            static fn (int $carry, int $value, int $key, iterable $iterable): int => $carry + $value,
            0
        ));

        $expected = [55];

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testEmptyInput(): void
    {
        $iterator = (new ReductionIterableAggregate(
            [],
            static fn (int $carry, int $value, int $key, iterable $iterable): int => $carry + $value,
            123
        ));

        $expected = [123];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
