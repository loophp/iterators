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
 * @implements IteratorAggregate<TKey, T>
 */
final class CachingIteratorAggregate implements IteratorAggregate
{
    /**
     * // TODO: Remove this when PSalm 5 is released.
     *
     * @psalm-var CachingIterator<int, array{0: TKey, 1: T}>
     * @phpstan-var CachingIterator<int, array{0: TKey, 1: T}, Generator<int, array{0: TKey, 1: T}>>
     */
    private CachingIterator $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIterator(
            (new PackIterableAggregate($iterator))->getIterator(),
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterator->getCache() as [$key, $current]) {
            yield $key => $current;
        }

        while ($this->iterator->hasNext()) {
            $this->iterator->next();

            [$key, $current] = $this->iterator->current();

            yield $key => $current;
        }
    }

    public function hasNext(): bool
    {
        return $this->iterator->hasNext();
    }
}
