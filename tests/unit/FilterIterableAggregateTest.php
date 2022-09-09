<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\FilterIterableAggregate;
use PHPUnit\Framework\TestCase;

use function count;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class FilterIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator = (new FilterIterableAggregate(
            range(0, 5),
            static fn (int $v, int $key, iterable $iterable): bool => 0 === (($v + 2 * $key + count($iterable)) % 2)
        ));

        $expected = [
            0 => 0,
            2 => 2,
            4 => 4,
        ];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
