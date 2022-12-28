<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\ReductionIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class ReductionIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator = (new ReductionIterableAggregate(
            range(0, 10),
            static fn (int $carry, int $value, int $key): int => $carry + $value + $key,
            0
        ));

        $expected = [0, 2, 6, 12, 20, 30, 42, 56, 72, 90, 110];

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testEmptyInput(): void
    {
        $iterator = (new ReductionIterableAggregate(
            [],
            static fn (int $carry, int $value, int $key): int => $carry + $value + $key,
            123
        ));

        $expected = [123];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
