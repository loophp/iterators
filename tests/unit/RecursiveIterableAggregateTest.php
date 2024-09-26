<?php

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\RecursiveIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class RecursiveIterableAggregateTest extends TestCase
{
    /**
     * @return Generator<array{0: array, 1: array}>
     */
    public static function provideBasicCases(): iterable
    {
        yield [
            [
                'i0' => [
                    'index' => 0,
                    'children' => [],
                ],
                'i1' => [
                    'index' => 1,
                    'children' => [],
                ],
            ],
            [
                'i0' => [
                    'index' => 0,
                    'children' => [],
                ],
                'i1' => [
                    'index' => 1,
                    'children' => [],
                ],
            ],
        ];

        yield [
            [
                'i0' => [
                    'index' => 0,
                    'children' => [
                        'i1' => [
                            'index' => 1,
                            'children' => [
                                'i2' => [
                                    'index' => 2,
                                    'children' => [],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'i0' => [
                    'index' => 0,
                    'children' => [
                        'i1' => [
                            'index' => 1,
                            'children' => [
                                'i2' => [
                                    'index' => 2,
                                    'children' => [],
                                ],
                            ],
                        ],
                    ],
                ],
                'i1' => [
                    'index' => 1,
                    'children' => [
                        'i2' => [
                            'index' => 2,
                            'children' => [],
                        ],
                    ],
                ],
                'i2' => [
                    'index' => 2,
                    'children' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider provideBasicCases
     */
    public function testBasic(array $input, array $expected): void
    {
        self::assertEquals(
            iterator_to_array(
                new RecursiveIterableAggregate($input, static fn (array $i) => $i['children'])
            ),
            $expected
        );
    }
}
