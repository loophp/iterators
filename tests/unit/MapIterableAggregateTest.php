<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\MapIterableAggregate;
use PHPUnit\Framework\TestCase;

use function gettype;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class MapIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator = (new MapIterableAggregate(
            range('a', 'c'),
            static fn (string $letter, int $key, iterable $iterable): string => sprintf('%s::%s::%s', $key, $letter, gettype($iterable))
        ));

        $expected = [
            '0::a::array',
            '1::b::array',
            '2::c::array',
        ];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
