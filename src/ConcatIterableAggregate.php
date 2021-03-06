<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use AppendIterator;
use Generator;
use IteratorAggregate;
use NoRewindIterator;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class ConcatIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<mixed, iterable<TKey, T>>
     */
    private iterable $iterables;

    /**
     * @param iterable<mixed, iterable<TKey, T>> $iterables
     */
    public function __construct(iterable $iterables)
    {
        $this->iterables = $iterables;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $iterator = new AppendIterator();

        foreach ($this->iterables as $iterable) {
            $iterator->append(
                new NoRewindIterator((new IterableIteratorAggregate($iterable))->getIterator())
            );
        }

        yield from $iterator;
    }
}
