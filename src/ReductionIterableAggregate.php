<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
 * @implements IteratorAggregate<TKey, W>
 */
final class ReductionIterableAggregate implements IteratorAggregate
{
    /**
     * @var Closure(W, T, TKey, iterable<TKey, T>): W
     */
    private Closure $closure;

    /**
     * @var W
     */
    private mixed $initial;

    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(W, T, TKey, iterable<TKey, T>): W) $closure
     * @param W $initial
     */
    public function __construct(iterable $iterable, Closure $closure, mixed $initial)
    {
        $this->iterable = $iterable;
        $this->closure = $closure;
        $this->initial = $initial;
    }

    /**
     * @return Generator<TKey, W>
     */
    public function getIterator(): Generator
    {
        $initial = $this->initial;

        foreach ($this->iterable as $key => $value) {
            $initial = ($this->closure)($initial, $value, $key, $this->iterable);

            yield $key => $initial;
        }
    }
}
