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
final class RandomIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(
        private readonly iterable $iterable,
        private readonly ?int $seed = null
    ) {}

    /**
     * @return Generator<TKey, T>
     *
     * @psalm-suppress InvalidArgument
     */
    public function getIterator(): Generator
    {
        yield from new UnpackIterableAggregate(
            new UnpackIterableAggregate(
                new SortIterableAggregate(
                    new MultipleIterableAggregate([
                        new RandomIntegerAggregate($this->seed),
                        new PackIterableAggregate($this->iterable),
                    ]),
                    static fn (array $a, array $b): int => $a[0] <=> $b[0]
                )
            )
        );
    }
}
