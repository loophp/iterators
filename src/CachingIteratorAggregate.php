<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Iterator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class CachingIteratorAggregate implements IteratorAggregate
{
    /**
     * @var IteratorAggregate<int|string, array{0: TKey, 1: T}>
     */
    private IteratorAggregate $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        /** @var Iterator<int|string, array{0: TKey, 1: T}> $innerIterator */
        $innerIterator = (new PackIterableAggregate($iterator))->getIterator();

        $this->iterator = new SimpleCachingIteratorAggregate($innerIterator);
    }

    /**
     * @return Iterator<TKey, T>
     */
    public function getIterator(): Iterator
    {
        yield from new UnpackIterableAggregate($this->iterator->getIterator());
    }
}
