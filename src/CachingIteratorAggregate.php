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
final class CachingIteratorAggregate implements IteratorAggregate
{
    /**
     * @var SimpleCachingIteratorAggregate<int, array{0: TKey, 1: T}>
     */
    private SimpleCachingIteratorAggregate $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new SimpleCachingIteratorAggregate((new PackIterableAggregate($iterator))->getIterator());
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterator as [$key, $current]) {
            yield $key => $current;
        }
    }

    public function hasNext(): bool
    {
        return $this->iterator->hasNext();
    }
}
