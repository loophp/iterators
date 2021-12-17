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
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class CachingIteratorAggregate implements IteratorAggregate
{
    /**
     * @var CachingIterator<TKey, T>
     */
    private CachingIterator $cache;

    /**
     * @var Iterator<TKey, T>
     */
    private Iterator $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = $iterator;
        $this->cache = new CachingIterator(
            (new PackIterableAggregate($iterator))->getIterator(),
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        /** @var iterable<int, array{0: TKey, 1: T}> $it */
        $it = $this->iterator->valid()
            ? $this->cache
            : $this->cache->getCache();

        yield from (new UnpackIterableAggregate($it))->getIterator();
    }
}
