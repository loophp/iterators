<?php

declare(strict_types=1);

namespace loophp\iterators;

use AppendIterator;
use Generator;
use IteratorAggregate;
use NoRewindIterator;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class ConcatIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<mixed, iterable<TKey, T>> $iterables
     */
    public function __construct(private iterable $iterables) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $iterator = new AppendIterator();

        foreach ($this->iterables as $iterable) {
            $iterator->append(
                new NoRewindIterator((new IterableIteratorAggregate($iterable))->getIterator())
            );
        }

        yield from $iterator;
    }
}
