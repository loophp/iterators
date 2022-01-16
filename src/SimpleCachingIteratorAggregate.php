<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use CachingIterator;
use Generator;
use Iterator;
use IteratorAggregate;

// phpcs:disable Generic.Files.LineLength.TooLong

/**
 * @template TKey of array-key
 * @template T
 *
 * @implements IteratorAggregate<array-key, T>
 */
final class SimpleCachingIteratorAggregate implements IteratorAggregate
{
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
     * @return Generator<array-key, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->iterator->getCache();

        while ($this->iterator->hasNext()) {
            $this->iterator->next();

            yield $this->iterator->key() => $this->iterator->current();
        }
    }
}
