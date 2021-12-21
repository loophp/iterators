<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\RandomIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class RandomIterableAggregateTest extends TestCase
{
    public function testSimple(): void
    {
        $input = static function (): Generator {
            yield from array_combine(range('a', 'e'), range('a', 'e'));
        };

        $seed = 4321;

        $iterator = (new RandomIterableAggregate($input(), $seed));

        $a = [];

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        $expected = [
            ['e', 'e'],
            ['d', 'd'],
            ['c', 'c'],
            ['b', 'b'],
            ['a', 'a'],
        ];

        self::assertEquals($expected, $a);
    }
}
