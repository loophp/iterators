<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;
use MultipleIterator;
use Traversable;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<int, array<TKey, T>>
 */
final class MultipleIterableAggregate implements IteratorAggregate
{
    /**
     * @var (0|1|2|3)
     */
    private int $flags;

    /**
     * @var iterable<mixed, iterable<TKey, T>>
     */
    private iterable $iterables;

    /**
     * @param iterable<mixed, iterable<TKey, T>> $iterables
     * @param (0|1|2|3) $flags
     */
    public function __construct(iterable $iterables, int $flags = MultipleIterator::MIT_NEED_ALL | MultipleIterator::MIT_KEYS_NUMERIC)
    {
        $this->flags = $flags;
        $this->iterables = $iterables;
    }

    /**
     * @return Generator<int, array<TKey, T>>
     */
    public function getIterator(): Traversable
    {
        $mit = new MultipleIterator($this->flags);

        foreach ($this->iterables as $iterable) {
            $mit->attachIterator(
                (new IterableIteratorAggregate($iterable))->getIterator()
            );
        }

        yield from $mit;
    }
}
