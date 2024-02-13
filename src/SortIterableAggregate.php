<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use Generator;
use IteratorAggregate;
use SplHeap;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class SortIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param Closure(T, T, TKey, TKey): int $callback
     */
    public function __construct(
        private readonly iterable $iterable,
        private readonly Closure $callback
    ) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $iterator = new /**
             * @template T
             * @template TKey
             *
             * @param iterable<TKey, T> $iterable
             * @param Closure(T, T, TKey, TKey): int $callback
             *
             * @extends SplHeap<array{0: int, 1:array{0:TKey, 1:T}}>
             */ class($this->iterable, $this->callback) extends SplHeap {
            /**
             * @param iterable<TKey, T> $iterable
             * @param Closure(T, T, TKey, TKey): int $callback
             */
            public function __construct(iterable $iterable, private Closure $callback)
            {
                foreach (new PackIterableAggregate($iterable) as $key => $value) {
                    $this->insert([$key, $value]);
                }
            }

            /**
             * @param array{0: int, 1:array{0:TKey, 1:T}}|mixed $value1
             * @param array{0: int, 1:array{0:TKey, 1:T}}|mixed $value2
             */
            protected function compare($value1, $value2): int
            {
                return (0 === $return = ($this->callback)($value2[1][1], $value1[1][1], $value2[1][0], $value1[1][0])) ? $value2[0] <=> $value1[0] : $return;
            }
        };

        foreach (new UnpackIterableAggregate($iterator) as $value) {
            yield $value[0] => $value[1];
        }
    }
}
