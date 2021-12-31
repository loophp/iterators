<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use CachingIterator;
use Iterator;
use IteratorAggregate;

/**
 * @template TKey of array-key
 * @template T
 *
 * @implements IteratorAggregate<int|string, T>
 */
final class SimpleCachingIteratorAggregate implements IteratorAggregate
{
    private bool $hasStarted = false;

    /**
     * @var CachingIterator<array-key, T>
     */
    private CachingIterator $iterator;

    /**
     * @param Iterator<array-key, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIterator(
            $iterator,
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Iterator<array-key, T>
     */
    public function getIterator(): Iterator
    {
        if (false === $this->hasStarted) {
            $this->hasStarted = true;
            $this->iterator->next();

            for (; $this->iterator->valid(); $this->iterator->next()) {
                yield $this->iterator->key() => $this->iterator->current();
            }

            return;
        }

        $this->iterator->next();

        for (; $this->iterator->valid(); $this->iterator->next()) {
            $this->iterator->current();
        }

        yield from $this->iterator->getCache();
    }
}
