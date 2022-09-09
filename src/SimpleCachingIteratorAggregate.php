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
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<array-key|TKey, T>
 *
 * @deprecated This iterator is not reliable when keys have type different from
 * int|string. The first loop keys are ok, but during the next loops, keys are
 * replaced by integers. This is mostly due to the fact that the method
 * CachingIterator::getCache returns an array.
 * In order to circumvent that, use CachingIteratorAggregate instead.
 */
final class SimpleCachingIteratorAggregate implements IteratorAggregate
{
    /**
     * // TODO: Remove this when PSalm 5 is released.
     *
     * @psalm-var CachingIterator<TKey, T>
     *
     * @phpstan-var CachingIterator<TKey, T, Iterator<TKey, T>>
     */
    private CachingIterator $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIterator(
            $iterator,
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Generator<array-key|TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->iterator->getCache();

        while ($this->iterator->hasNext()) {
            $this->iterator->next();

            yield $this->iterator->key() => $this->iterator->current();
        }
    }

    public function hasNext(): bool
    {
        return $this->iterator->hasNext();
    }
}
