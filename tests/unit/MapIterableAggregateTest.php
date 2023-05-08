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
 *
 * @coversDefaultClass \loophp\iterators
 */
final class MapIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $input = array_combine(range('a', 'c'), range('a', 'c'));

        $iterator = (new MapIterableAggregate(
            $input,
            static fn (string $letter, string $key, iterable $iterable): string => sprintf('%s::%s::%s', $key, $letter, gettype($iterable))
        ));

        $expected = [
            'a' => 'a::a::array',
            'b' => 'b::b::array',
            'c' => 'c::c::array',
        ];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
