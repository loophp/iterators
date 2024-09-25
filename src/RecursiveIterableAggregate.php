<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use Generator;
use Iterator;
use IteratorAggregate;
use SplStack;

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
        /** @var SplStack<Iterator> $iterables */
        $iterables = new SplStack();
        $iterables->push(new IterableIterator($this->iterable));

        while (!$iterables->isEmpty()) {
            $currentIterable = $iterables->top();

            while ($currentIterable->valid()) {
                $currentValue = $currentIterable->current();
                $currentKey = $currentIterable->key();

                yield $currentKey => $currentValue;

                $subIterable = new IterableIterator(
                    ($this->closure)($currentValue, $currentKey, $this->iterable)
                );

                $currentIterable->next();
                $subIterable->rewind();

                if ($subIterable->valid()) {
                    $iterables->push($subIterable);

                    continue 2;
                }
            }

            $iterables->pop();
        }
    }
}
