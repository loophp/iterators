<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use Generator;
use loophp\iterators\IterableIterator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class IterableIteratorTest extends TestCase
{
    public function testGetAnIntKey(): void
    {
        $iterator = new IterableIterator(range(1, 5));
        self::assertEquals(0, $iterator->key());
        $iterator->next();
        self::assertEquals(1, $iterator->key());
    }

    public function testGetAStringKey(): void
    {
        $iterator = new IterableIterator(['foo' => 1, 'bar' => 2]);
        self::assertEquals('foo', $iterator->key());
        $iterator->next();
        self::assertEquals('bar', $iterator->key());
    }

    public function testIsInitializableFromArray(): void
    {
        $iterator = new IterableIterator(['foo', 'bar', 'baz']);

        self::assertEquals('foo', $iterator->current());
    }

    public function testIsInitializableFromGenerator(): void
    {
        $gen = static fn (): Generator => yield from ['foo', 'bar', 'baz'];

        $iterator = new IterableIterator($gen());

        self::assertEquals('foo', $iterator->current());
    }

    public function testIsInitializableFromIterator(): void
    {
        $iterator = new IterableIterator(new ArrayIterator(['foo', 'bar', 'baz']));

        self::assertEquals('foo', $iterator->current());
    }

    public function testRewind(): void
    {
        $iterator = new IterableIterator(['foo']);

        self::assertEquals('foo', $iterator->current());
        $iterator->next();
        self::assertNull($iterator->current());

        $iterator->rewind();

        self::assertEquals('foo', $iterator->current());
    }

    public function testUseNext(): void
    {
        $iterator = new IterableIterator(range(1, 5));

        self::assertNull($iterator->next());

        self::assertEquals(2, $iterator->current());
    }
}
