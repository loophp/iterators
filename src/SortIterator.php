<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use SplHeap;

/**
 * @template TKey
 * @template T
 *
 * @extends SplHeap<T>
 */
final class SortIterator extends SplHeap
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param Closure(T, T): int $callback
     */
    public function __construct(private iterable $iterable, private Closure $callback)
    {
        foreach ($iterable as $value) {
            $this->insert($value);
        }
    }

    /**
     * @param T $left
     * @param T $right
     */
    public function compare($left, $right): int
    {
        return ($this->callback)($left, $right);
    }
}
