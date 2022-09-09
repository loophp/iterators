<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\ClosureIterator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class ClosureIteratorTest extends TestCase
{
    private const LIST_DATA = [1, 2, 3];

    private const MAP_DATA = ['foo' => 1, 'bar' => 2];

    public function testInitializeFromCallableWithArray(): void
    {
        $iterator = new ClosureIterator(
            static fn (array $iterable): array => $iterable,
            [self::LIST_DATA]
        );

        self::assertTrue($iterator->valid());

        self::assertSame(
            self::LIST_DATA,
            iterator_to_array($iterator)
        );
    }

    public function testRewind(): void
    {
        $iterator = new ClosureIterator(
            static fn (array $iterable): array => $iterable,
            [range('a', 'e')]
        );

        self::assertSame('a', $iterator->current());
        $iterator->next();
        self::assertSame('b', $iterator->current());
        $iterator->next();
        self::assertSame('c', $iterator->current());

        $iterator->rewind();

        self::assertSame('a', $iterator->current());
    }
}
