<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use Generator;
use loophp\iterators\SimpleCachingIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class SimpleCachingIteratorAggregateTest extends TestCase
{
    public function testHasNext(): void
    {
        $range = range('a', 'c');
        $iteratorAggregate = new SimpleCachingIteratorAggregate(new ArrayIterator($range));
        $iterator = $iteratorAggregate->getIterator();

        self::assertTrue($iteratorAggregate->hasNext());
        $iterator->next();
        self::assertTrue($iteratorAggregate->hasNext());
        $iterator->next();
        self::assertFalse($iteratorAggregate->hasNext());
    }

    public function testWithAGenerator(): void
    {
        $input = static function () use (&$stack): Generator {
            $input = range('a', 'c');

            foreach (array_combine($input, $input) as $key => $value) {
                $stack[] = [$key, $value];

                yield $key => $value;
            }
        };

        $iterator = (new SimpleCachingIteratorAggregate($input()));

        $a = iterator_to_array($iterator);
        $b = iterator_to_array($iterator);

        self::assertSame($a, $b);

        $expected = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
        ];

        self::assertSame($expected, $a);
    }

    public function testWithAHalfAGenerator(): void
    {
        $input = static function () use (&$stack): Generator {
            $breakAt = 2;
            $input = array_combine(range('a', 'e'), range('a', 'e'));

            foreach ($input as $key => $value) {
                $stack[] = [$key, $value];

                yield [$key, $value];

                if (0 === $breakAt--) {
                    break;
                }
            }

            foreach ($input as $key => $value) {
                $stack[] = [$key, $value];

                yield [$key, $value];
            }
        };

        $iterator = (new SimpleCachingIteratorAggregate($input()));

        $a = iterator_to_array($iterator);
        $b = iterator_to_array($iterator);

        self::assertSame($a, $b);

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

        self::assertSame($expected, $a);
    }

    public function testConsecutiveCachingFromInnerTraversals(): void
    {
        $iterator = new SimpleCachingIteratorAggregate(new ArrayIterator([1, 2, 3, 4, 5, 6]));

        $outerItems = [];

        foreach ($iterator as $outerItem) {
            if ($outerItem === 2) {
                $innerItems = [];

                foreach ($iterator as $innerItem) {
                    $innerItems[] = $innerItem;

                    if ($innerItem === 4) {
                        break;
                    }
                }

                self::assertSame([1, 2, 3, 4], $innerItems);
            }

            $outerItems[] = $outerItem;
        }

        self::assertSame([1, 2, 3, 4, 5, 6], $outerItems);
    }
}
