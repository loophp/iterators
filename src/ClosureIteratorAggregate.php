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
final class ClosureIteratorAggregate implements IteratorAggregate
{
    /**
     * @var callable(mixed ...$parameters): iterable<TKey, T>
     */
    private $callable;

    /**
     * @param callable(mixed ...$parameters): iterable<TKey, T> $callable
     * @param iterable<int, mixed> $parameters
     */
    public function __construct(callable $callable, private iterable $parameters = [])
    {
        $this->callable = $callable;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from ($this->callable)(...$this->parameters);
    }
}
