<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\RandomIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class RandomIteratorAggregateTest extends TestCase
{
    public function testSimple(): void
    {
        $input = static function (): Generator {
            yield from array_combine(range('a', 'e'), range('a', 'e'));
        };

        $seed = 4321;

        $iterator = (new RandomIteratorAggregate($input(), $seed));

        $a = $b = [];

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        foreach ($iterator as $key => $value) {
            $b[] = [$key, $value];
        }

        self::assertEquals($a, $b);

        $expected = [
            ['b', 'b'],
            ['e', 'e'],
            ['c', 'c'],
            ['d', 'd'],
            ['a', 'a'],
        ];

        self::assertEquals($expected, $a);
    }
}
