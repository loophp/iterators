<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

use function in_array;

use const PHP_INT_MAX;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class UniqueIterableAggregate implements IteratorAggregate
{
    /**
     * @var InterruptableIterableIteratorAggregate<TKey, T>
     */
    private InterruptableIterableIteratorAggregate $iterable;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable, private int $retries = PHP_INT_MAX)
    {
        $this->iterable = new InterruptableIterableIteratorAggregate($iterable);
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $retries = $this->retries;
        $seen = [];

        foreach ($this->iterable as $generator => [$key, $value]) {
            if (0 === $retries) {
                $generator->send(InterruptableIterableIteratorAggregate::BREAK);
            }

            if (in_array($value, $seen, true)) {
                --$retries;

                continue;
            }

            $seen[] = $value;

            yield $key => $value;
        }
    }
}
