<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use loophp\iterators\MultipleIterableAggregate;
use loophp\iterators\NormalizeIterableAggregate;
use MultipleIterator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class MultipleIterableAggregateTest extends TestCase
{
    public static function provideBasicCases(): iterable
    {
        $generator = static function () {
            yield from range('a', 'c');
        };
        $iterator = new ArrayIterator(range('d', 'f'));
        $array = range('g', 'i');

        yield [
            [$generator(), $iterator, $array],
            [
                [
                    'a',
                    'd',
                    'g',
                ],
                [
                    'b',
                    'e',
                    'h',
                ],
                [
                    'c',
                    'f',
                    'i',
                ],
            ],
        ];
    }

    public static function provideFlagsCases(): iterable
    {
        yield [
            [range('a', 'c'), range('d', 'e')],
            MultipleIterator::MIT_NEED_ALL,
            [
                [
                    'a',
                    'd',
                ],
                [
                    'b',
                    'e',
                ],
            ],
        ];

        yield [
            [range('a', 'c'), range('d', 'e')],
            MultipleIterator::MIT_NEED_ANY,
            [
                [
                    'a',
                    'd',
                ],
                [
                    'b',
                    'e',
                ],
                [
                    'c',
                    null,
                ],
            ],
        ];
    }

    /**
     * @dataProvider provideBasicCases
     */
    public function testBasic(array $iterables, array $expected): void
    {
        $iterator = new NormalizeIterableAggregate(
            new MultipleIterableAggregate($iterables)
        );

        self::assertSame($expected, iterator_to_array($iterator));
    }

    /**
     * @dataProvider provideFlagsCases
     */
    public function testFlags(array $iterables, int $flags, array $expected): void
    {
        $iterator = new NormalizeIterableAggregate(
            new MultipleIterableAggregate($iterables, $flags)
        );

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
