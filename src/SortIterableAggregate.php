<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<int, T>
 */
final class SortIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(T, T): int) $callback
     */
    public function __construct(private iterable $iterable, private Closure $callback) {}

    /**
     * @return Generator<int, T>
     */
    public function getIterator(): Generator
    {
        yield from new SortIterator($this->iterable, $this->callback);
    }
}
