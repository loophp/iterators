<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use Iterator;

/**
 * @template TKey
 * @template T
 *
 * @implements Iterator<TKey, T>
 */
final class ClosureIterator implements Iterator
{
    /**
     * @var callable(mixed): iterable<TKey, T>
     */
    private $callable;

    /**
     * @var Generator<TKey, T, mixed, void>
     */
    private Generator $generator;

    /**
     * @param callable(mixed): iterable<TKey, T> $callable
     * @param iterable<int, mixed> $parameters
     */
    public function __construct(callable $callable, private iterable $parameters = [])
    {
        $this->callable = $callable;
        $this->generator = $this->getGenerator();
    }

    /**
     * @return T
     */
    public function current(): mixed
    {
        return $this->generator->current();
    }

    /**
     * @return TKey
     */
    public function key(): mixed
    {
        return $this->generator->key();
    }

    public function next(): void
    {
        $this->generator->next();
    }

    public function rewind(): void
    {
        $this->generator = $this->getGenerator();
    }

    public function valid(): bool
    {
        return $this->generator->valid();
    }

    /**
     * @return Generator<TKey, T, mixed, void>
     */
    private function getGenerator(): Generator
    {
        yield from ($this->callable)(...$this->parameters);
    }
}
