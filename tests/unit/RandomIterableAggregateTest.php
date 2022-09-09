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

use function count;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class RandomIterableAggregateTest extends TestCase
{
    public function testSeed(): void
    {
        $input = static function (): Generator {
            yield from array_combine(range('a', 'z'), range('a', 'z'));
        };

        $iterator = (new RandomIterableAggregate($input()));

        $a = [];

        foreach ($iterator as $key => $value) {
            $a[$key] = $value;
        }

        $expected = array_combine(range('a', 'z'), range('a', 'z'));

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }

    public function testSimple(): void
    {
        $input = static function (): Generator {
            yield from array_combine(range('a', 'f'), range('a', 'f'));
        };

        $seed = 2;

        $iterator = (new RandomIterableAggregate($input(), $seed));

        $a = [];

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        $expected = [
            ['a', 'a'],
            ['b', 'b'],
            ['d', 'd'],
            ['f', 'f'],
            ['c', 'c'],
            ['e', 'e'],
        ];

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }
}
