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
 * @implements IteratorAggregate<TKey, T>
 */
class RecursiveIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(T, TKey, iterable<TKey, T>): iterable<TKey, T>) $closure
     */
    public function __construct(private iterable $iterable, private Closure $closure) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->flatten($this->iterable);
    }

    /**
     * @param iterable<TKey, T> $items
     *
     * @return Generator<TKey, T>
     */
    private function flatten(iterable $items): Generator
    {
        foreach ($items as $key => $value) {
            yield $key => $value;

            yield from $this->flatten(($this->closure)($value, $key, $this->iterable));
        }
    }
}
