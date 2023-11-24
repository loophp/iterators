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
    public function __construct(iterable $iterable, private Closure $callback)
    {
        foreach ($iterable as $value) {
            $this->insert($value);
        }
    }

    /**
     * @param T $value1
     * @param T $value2
     */
    protected function compare($value1, $value2): int
    {
        return ($this->callback)($value1, $value2);
    }
}
