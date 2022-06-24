<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use Iterator;
use ReturnTypeWillChange;

/**
 * @template TKey
 * @template T
 *
 * @implements Iterator<TKey, T>
 */
final class IterableIterator implements Iterator
{
    /**
     * @var ClosureIterator<TKey, T>
     */
    private ClosureIterator $iterator;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterator = new ClosureIterator(
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
     * @return T
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * @return TKey
     */
    #[ReturnTypeWillChange]
    public function key()
    {
        return $this->iterator->key();
    }

    public function next(): void
    {
        $this->iterator->next();
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }
}
