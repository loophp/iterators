<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

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
}
