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
            static fn (int $carry, int $value, int $key, iterable $iterable): int => $carry + $value,
            0
        ));

        $expected = [0, 1, 3, 6, 10, 15, 21, 28, 36, 45, 55];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
