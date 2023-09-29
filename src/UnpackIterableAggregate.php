<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class UnpackIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<array-key, array{0: TKey, 1: T}> $iterable
     */
    public function __construct(private iterable $iterable) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as [$key, $value]) {
            yield $key => $value;
        }
    }
}
