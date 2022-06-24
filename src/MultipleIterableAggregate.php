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

// phpcs:disable Generic.Files.LineLength.TooLong

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<array<int, TKey|null>, array<int, T|null>>
 */
final class MultipleIterableAggregate implements IteratorAggregate
{
    /**
     * @var (0|1|2|3)
     */
    private int $flags;

    /**
     * @var iterable<array-key, iterable<TKey, T>>
     */
    private iterable $iterables;

    /**
     * @param iterable<array-key, iterable<TKey, T>> $iterables
     * @param (0|1|2|3) $flags
     */
    public function __construct(iterable $iterables, int $flags = MultipleIterator::MIT_NEED_ALL | MultipleIterator::MIT_KEYS_NUMERIC)
    {
        $this->flags = $flags;
        $this->iterables = $iterables;
    }

    /**
     * @return Generator<array<int, TKey|null>, array<int, T|null>>
     */
    public function getIterator(): Generator
    {
        $mit = new MultipleIterator($this->flags);

        foreach ($this->iterables as $key => $iterable) {
            $mit->attachIterator(
                (new IterableIteratorAggregate($iterable))->getIterator(),
                $key
            );
        }

        yield from $mit;
    }
}
