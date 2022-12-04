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
final class MapIterableAggregate implements IteratorAggregate
{
    /**
     * @var Closure(T, TKey, iterable<TKey, T>): W
     */
    private Closure $closure;

    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(T, TKey, iterable<TKey, T>): W) $closure
     */
    public function __construct(private iterable $iterable, Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @return Generator<TKey, W>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as $key => $value) {
            yield $key => ($this->closure)($value, $key, $this->iterable);
        }
    }
}
