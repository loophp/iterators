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
use Traversable;

/**
 * @template TKey of array-key
 * @template T
 *
 * @implements IteratorAggregate<int|string, T>
 */
final class SimpleCachingIteratorAggregate implements IteratorAggregate
{
    private bool $isDone = false;

    /**
     * @var CachingIterator<int|string, T>
     */
    private CachingIterator $iterator;

    /**
     * @param Iterator<int|string, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIterator(
            $iterator,
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Traversable<int|string, T>
     */
    public function getIterator(): Traversable
    {
        if (true === $this->isDone) {
            return yield from $this->iterator->getCache();
        }

        $this->iterator->next();

        for (; $this->iterator->valid(); $this->iterator->next()) {
            $this->iterator->current();
        }

        $this->isDone = true;

        yield from $this->iterator->getCache();
    }
}
