<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 * @template W
 *
 * @implements IteratorAggregate<TKey|int, W>
 */
final class ReductionIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(W, T, TKey, iterable<TKey, T>): W) $closure
     * @param W $initial
     */
    public function __construct(private iterable $iterable, private Closure $closure, private mixed $initial) {}

    /**
     * @return Generator<TKey|int, W>
     */
    public function getIterator(): Generator
    {
        yield $initial = $this->initial;

        foreach ($this->iterable as $key => $value) {
            $initial = ($this->closure)($initial, $value, $key, $this->iterable);

            yield $key => $initial;
        }
    }
}
