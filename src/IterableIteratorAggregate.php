<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use Iterator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class IterableIteratorAggregate implements IteratorAggregate
{
    /**
     * @var IteratorAggregate<TKey, T>
     */
    private IteratorAggregate $iterator;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterator = new ClosureIteratorAggregate(
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return Generator<TKey, T>
             */
            static fn (iterable $iterable): Generator => yield from $iterable,
            [$iterable]
        );
    }

    /**
     * @return Iterator<TKey, T>
     */
    public function getIterator(): Iterator
    {
        yield from $this->iterator->getIterator();
    }
}
