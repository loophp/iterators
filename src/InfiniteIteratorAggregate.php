<?php

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
final class InfiniteIteratorAggregate implements IteratorAggregate
{
    /**
     * @var CachingIteratorAggregate<TKey, T>
     */
    private CachingIteratorAggregate $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIteratorAggregate($iterator);
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->iterator;

        yield from $this->getIterator();
    }
}
