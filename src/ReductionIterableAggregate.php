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
 * @implements IteratorAggregate<TKey|int, W>
 */
final class ReductionIterableAggregate implements IteratorAggregate
{
    /**
     * @var Closure(W, T, TKey, iterable<TKey, T>): W
     */
    private Closure $closure;

    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(W, T, TKey, iterable<TKey, T>): W) $closure
     * @param W $initial
     */
    public function __construct(private iterable $iterable, Closure $closure, private mixed $initial)
    {
        $this->closure = $closure;
    }

    /**
     * @return Generator<TKey|int, W>
     */
    public function getIterator(): Generator
    {
        $isEmpty = true;
        $initial = $this->initial;

        foreach ($this->iterable as $key => $value) {
            $isEmpty = false;
            $initial = ($this->closure)($initial, $value, $key, $this->iterable);

            yield $key => $initial;
        }

        if (true === $isEmpty) {
            yield $initial;
        }
    }
}
