<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;
use LimitIterator;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class LimitIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(private iterable $iterable, private int $offset = 0, private int $limit = -1) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from new LimitIterator(
            (new IterableIteratorAggregate($this->iterable))->getIterator(),
            $this->offset,
            $this->limit
        );
    }
}
