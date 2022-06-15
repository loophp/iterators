<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\ChunkIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class ChunkIterableAggregateTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator = (new ChunkIterableAggregate(
            range('a', 'j'),
            2
        ));

        $expected = [
            ['a', 'b'],
            ['c', 'd'],
            ['e', 'f'],
            ['g', 'h'],
            ['i', 'j'],
        ];

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
