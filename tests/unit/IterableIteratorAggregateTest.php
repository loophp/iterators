<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use Generator;
use loophp\iterators\IterableIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class IterableIteratorAggregateTest extends TestCase
{
    public function testGetAnIntKey(): void
    {
        $iterator = (new IterableIteratorAggregate(range(1, 5)))->getIterator();

        self::assertSame(0, $iterator->key());
        $iterator->next();
        self::assertSame(1, $iterator->key());
    }

    public function testGetAStringKey(): void
    {
        $iterator = (new IterableIteratorAggregate(['foo' => 1, 'bar' => 2]))->getIterator();
        self::assertSame('foo', $iterator->key());
        $iterator->next();
        self::assertSame('bar', $iterator->key());
    }

    public function testIsInitializableFromArray(): void
    {
        $iterator = (new IterableIteratorAggregate(['foo', 'bar', 'baz']))->getIterator();

        self::assertSame('foo', $iterator->current());
    }

    public function testIsInitializableFromGenerator(): void
    {
        $gen = static fn (): Generator => yield from ['foo', 'bar', 'baz'];

        $iterator = (new IterableIteratorAggregate($gen()))->getIterator();

        self::assertSame('foo', $iterator->current());
    }

    public function testIsInitializableFromIterator(): void
    {
        $iterator = (new IterableIteratorAggregate(new ArrayIterator(['foo', 'bar', 'baz'])))->getIterator();

        self::assertSame('foo', $iterator->current());
    }

    public function testRenewGenerator(): void
    {
        $iia = new IterableIteratorAggregate(['foo']);
        $iterator = $iia->getIterator();

        self::assertSame('foo', $iterator->current());
        $iterator->next();
        self::assertNull($iterator->current());

        // Iterator renewal here (instead of using rewind)
        $iterator = $iia->getIterator();

        self::assertSame('foo', $iterator->current());
    }

    public function testUseNext(): void
    {
        $iterator = (new IterableIteratorAggregate(range(1, 5)))->getIterator();

        self::assertNull($iterator->next());

        self::assertSame(2, $iterator->current());
    }
}
