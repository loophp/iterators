<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\MapIterableAggregate;
use loophp\iterators\SortIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class SortIterableAggregateTest extends TestCase
{
    public function testDoNothing(): void
    {
        $input = range('a', 'f');

        $iterator = (new SortIterableAggregate($input, static fn (string $left, string $right): int => $left <=> $right));

        $actual = array_reduce(
            iterator_to_array($iterator),
            static fn (array $carry, string $item): array => [...$carry, $item],
            []
        );

        self::assertSame($input, $actual);
    }

    public function testSimpleSort(): void
    {
        $input = array_combine(range('c', 'a'), range('c', 'a'));

        $iterator = (new SortIterableAggregate($input, static fn (string $left, string $right): int => $left <=> $right));

        $actual = array_reduce(
            iterator_to_array($iterator),
            static fn (array $carry, string $item): array => [...$carry, $item],
            []
        );

        self::assertSame(range('a', 'c'), $actual);
    }

    public function testSortingDirectionMatchUsort(): void
    {
        $input = [
            self::createValueObject(id: 1, weight: 2),
            self::createValueObject(id: 160, weight: 1),
            self::createValueObject(id: 1600, weight: 3),
            self::createValueObject(id: 2, weight: 2),
            self::createValueObject(id: 150, weight: 1),
            self::createValueObject(id: 1500, weight: 3),
            self::createValueObject(id: 3, weight: 2),
        ];

        $sortCallback = static fn (object $a, object $b): int => $a->weight <=> $b->weight;

        $actual = array_reduce(
            iterator_to_array(new SortIterableAggregate($input, $sortCallback)),
            static fn (array $carry, object $item): array => [...$carry, $item->id],
            []
        );

        usort($input, $sortCallback);
        $expected = array_map(static fn (object $item): int => $item->id, $input);

        self::assertEquals($expected, $actual);
    }

    public function testStableSort(): void
    {
        $input = [
            self::createValueObject(id: 1, weight: 1),
            self::createValueObject(id: 2, weight: 1),
            self::createValueObject(id: 3, weight: 1),
        ];

        $sort = new SortIterableAggregate($input, static fn (object $a, object $b): int => $a->weight <=> $b->weight);

        $expected = range(1, 3);

        self::assertSame($expected, iterator_to_array(new MapIterableAggregate($sort, static fn (object $value): int => $value->id)));
    }

    private static function createValueObject(int $id, int $weight): object
    {
        return new class($id, $weight) {
            public function __construct(
                public int $id,
                public int $weight,
            ) {}
        };
    }
}
