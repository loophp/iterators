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
     * @var UnpackIterableAggregate<TKey, T>
     */
    private UnpackIterableAggregate $iteratorAggregate;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iteratorAggregate = (new UnpackIterableAggregate(new SimpleCachingIteratorAggregate((new PackIterableAggregate($iterator))->getIterator())));
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->iteratorAggregate->getIterator();
    }
}
