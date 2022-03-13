<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use Generator;
use loophp\iterators\CachingIteratorAggregate;
use PHPUnit\Framework\TestCase;
use Traversable;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class CachingIteratorAggregateTest extends TestCase
{
    public function testHasNext(): void
    {
        $range = range('a', 'c');
        $iteratorAggregate = new CachingIteratorAggregate(new ArrayIterator($range));
        $iterator = $iteratorAggregate->getIterator();

        self::assertTrue($iteratorAggregate->hasNext());
        $iterator->next();
        self::assertTrue($iteratorAggregate->hasNext());
        $iterator->next();
        self::assertFalse($iteratorAggregate->hasNext());
    }

    public function testWithAGenerator(): void
    {
        $input = static function (): Generator {
            $range = range('a', 'e');

            yield from array_combine($range, $range);
        };

        $iterator = (new CachingIteratorAggregate($input()));
        $breakAt = 2;

        $a = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $b = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $c = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $d = iterator_to_array($this->doTheLoop($iterator, $breakAt));

        $expected = [
            ['a', 'a'],
            ['b', 'b'],
            ['c', 'c'],
            ['a', 'a'],
            ['b', 'b'],
            ['c', 'c'],
            ['d', 'd'],
            ['e', 'e'],
        ];

        self::assertSame($a, $b);
        self::assertSame($b, $c);
        self::assertSame($c, $d);
        self::assertSame($expected, $a);
    }

    public function testWithAGeneratorHavingUncommonKeys(): void
    {
        $input = static function (): Generator {
            yield ['a'] => 'array';

            yield true => 'bool';

            yield false => 'bool';
        };

        $iterator = (new CachingIteratorAggregate($input()));
        $breakAt = 1;

        $a = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $b = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $c = iterator_to_array($this->doTheLoop($iterator, $breakAt));
        $d = iterator_to_array($this->doTheLoop($iterator, $breakAt));

        $expected = [
            [['a'], 'array'],
            [true, 'bool'],
            [['a'], 'array'],
            [true, 'bool'],
            [false, 'bool'],
        ];

        self::assertSame($a, $b);
        self::assertSame($b, $c);
        self::assertSame($c, $d);
        self::assertSame($expected, $a);
    }

    private function doTheLoop(Traversable $iterator, int $breakAt): Generator
    {
        foreach ($iterator as $key => $value) {
            yield [$key, $value];

            if (0 === $breakAt--) {
                break;
            }
        }

        foreach ($iterator as $key => $value) {
            yield [$key, $value];
        }
    }
}
