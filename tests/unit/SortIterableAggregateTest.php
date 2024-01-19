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
        $input = ['a', 'b', 'c', 'd', 'e', 'f'];

        $iterator = (new SortIterableAggregate($input, static fn ($right, $left): int => $left <=> $right));

        $expected = [];

        foreach ($iterator as $value) {
            $expected[] = $value;
        }

        self::assertSame($expected, $input);
    }

    public function testSimpleSort(): void
    {
        $input = array_combine(range('c', 'a'), range('c', 'a'));

        $iterator = (new SortIterableAggregate($input, static fn ($right, $left): int => $left <=> $right));

        $expected = [];

        foreach ($iterator as $value) {
            $expected[] = $value;
        }

        self::assertSame($expected, range('a', 'c'));
    }

    public function testStableSort(): void
    {
        $valueObjectFactory = static fn (int $id, int $weight) => new class($id, $weight) {
            public function __construct(
                public readonly int $id,
                public readonly int $weight,
            ) {}
        };

        $input = [
            $valueObjectFactory(id: 1, weight: 1),
            $valueObjectFactory(id: 2, weight: 1),
            $valueObjectFactory(id: 3, weight: 1),
        ];

        $sort = new SortIterableAggregate($input, static fn (object $a, object $b): int => $a->weight <=> $b->weight);

        $expected = [1, 2, 3];

        self::assertSame($expected, iterator_to_array(new MapIterableAggregate($sort, static fn (object $value): int => $value->id)));
    }
}
