<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

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
     * @var SimpleCachingIteratorAggregate<int, array{0: TKey, 1:T}>
     */
    private SimpleCachingIteratorAggregate $cachingIterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->cachingIterator = new SimpleCachingIteratorAggregate((new PackIterableAggregate($iterator))->getIterator());
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from (new UnpackIterableAggregate($this->cachingIterator))->getIterator();
    }

    public function hasNext(): bool
    {
        return $this->cachingIterator->hasNext();
    }
}
