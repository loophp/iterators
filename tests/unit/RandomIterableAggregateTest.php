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

use const PHP_VERSION_ID;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class RandomIterableAggregateTest extends TestCase
{
    public function testSeedWithPHP81AndSmaller(): void
    {
        if (PHP_VERSION_ID >= 80200) {
            self::markTestSkipped('This test is only for PHP 8.1 and smaller.');
        }

        $input = static function (): Generator {
            yield from array_combine(range('a', 'z'), range('a', 'z'));
        };

        $iterator = (new RandomIterableAggregate($input(), 0));

        $a = [];

        foreach ($iterator as $key => $value) {
            $a[$key] = $value;
        }

        $expected = [
            'q' => 'q',
            'l' => 'l',
            'd' => 'd',
            'a' => 'a',
            'm' => 'm',
            'o' => 'o',
            'p' => 'p',
            'c' => 'c',
            'y' => 'y',
            'z' => 'z',
            'f' => 'f',
            'b' => 'b',
            's' => 's',
            'x' => 'x',
            'k' => 'k',
            'v' => 'v',
            'r' => 'r',
            't' => 't',
            'j' => 'j',
            'h' => 'h',
            'e' => 'e',
            'n' => 'n',
            'g' => 'g',
            'w' => 'w',
            'i' => 'i',
            'u' => 'u',
        ];

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }

    public function testSeedWithPHP82AndGreater(): void
    {
        if (PHP_VERSION_ID < 80200) {
            self::markTestSkipped('This test is only for PHP 8.1 and smaller.');
        }

        $input = static function (): Generator {
            yield from array_combine(range('a', 'z'), range('a', 'z'));
        };

        $iterator = (new RandomIterableAggregate($input(), 0));

        $a = [];

        foreach ($iterator as $key => $value) {
            $a[$key] = $value;
        }

        $expected = [
            'w' => 'w',
            'h' => 'h',
            'z' => 'z',
            'a' => 'a',
            'e' => 'e',
            's' => 's',
            'p' => 'p',
            'x' => 'x',
            'y' => 'y',
            'i' => 'i',
            'g' => 'g',
            'v' => 'v',
            'k' => 'k',
            'n' => 'n',
            'o' => 'o',
            'b' => 'b',
            'd' => 'd',
            'c' => 'c',
            'q' => 'q',
            't' => 't',
            'f' => 'f',
            'm' => 'm',
            'r' => 'r',
            'u' => 'u',
            'j' => 'j',
            'l' => 'l',
        ];

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }

    public function testSimpleWithPHP81AndSmaller(): void
    {
        if (PHP_VERSION_ID >= 80200) {
            self::markTestSkipped('This test is only for PHP 8.1 and smaller.');
        }

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
            ['b', 'b'],
            ['c', 'c'],
            ['f', 'f'],
            ['e', 'e'],
            ['d', 'd'],
            ['a', 'a'],
        ];

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }

    public function testSimpleWithPHP82AndGreater(): void
    {
        if (PHP_VERSION_ID < 80200) {
            self::markTestSkipped('This test is only for PHP 8.2 and greater.');
        }

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
            ['f', 'f'],
            ['a', 'a'],
            ['e', 'e'],
            ['b', 'b'],
            ['c', 'c'],
            ['d', 'd'],
        ];

        self::assertSame(iterator_count($input()), count($expected));
        self::assertSame($expected, $a);
    }
}
