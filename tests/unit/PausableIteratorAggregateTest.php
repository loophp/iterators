<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\PausableIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class PausableIteratorAggregateTest extends TestCase
{
    public function testGetRest(): void
    {
        $input = static function (): Generator {
            yield from range('a', 'e');
        };

        $iterator = (new PausableIteratorAggregate($input()));

        $a = $r = [];
        $i = 0;

        foreach ($iterator->rest() as $key => $value) {
            $r[] = [$key, $value];
        }

        self::assertEmpty($r);

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];

            if (2 === $i++) {
                break;
            }
        }

        foreach ($iterator->rest() as $key => $value) {
            $a[] = [$key, $value];
        }

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        $expected = [
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
            [3, 'd'],
            [4, 'e'],
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
            [3, 'd'],
            [4, 'e'],
        ];

        self::assertEquals($expected, $a);
    }

    public function testSimple(): void
    {
        $input = static function (): Generator {
            yield from range('a', 'e');
        };

        $iterator = (new PausableIteratorAggregate($input()));

        $a = $b = [];
        $i = 0;

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];

            if (2 === $i++) {
                break;
            }
        }

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        $expected = [
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
            [3, 'd'],
            [4, 'e'],
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
            [3, 'd'],
            [4, 'e'],
        ];

        self::assertEquals($expected, $a);
    }
}
